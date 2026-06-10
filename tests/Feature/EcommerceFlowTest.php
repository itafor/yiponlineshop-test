<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Services\CloudinaryUploader;
use App\Services\PaystackPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EcommerceFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_shop_and_checkout(): void
    {
        $this->seed();

        $product = Product::firstOrFail();
        $customer = $this->customerUser();

        $this->mock(PaystackPayment::class, function ($mock): void {
            $mock->shouldReceive('initialize')
                ->once()
                ->andReturn([
                    'authorization_url' => 'https://checkout.paystack.com/demo',
                    'reference' => 'YIP-TEST-REFERENCE',
                ]);
        });

        $this->get('/')->assertOk()->assertSee($product->name);
        $this->get('/products/'.$product->slug)->assertOk()->assertSee('Add to Cart');

        $this->post('/cart/'.$product->slug, ['quantity' => 2])
            ->assertRedirect('/cart');

        $this->actingAs($customer)
            ->get('/checkout')
            ->assertOk()
            ->assertSee('Order Summary');

        $this->actingAs($customer)
            ->post('/checkout', ['shipping_address' => '15 Demo Street, Lagos'])
            ->assertRedirect('https://checkout.paystack.com/demo');

        $this->assertDatabaseHas('orders', [
            'customer_email' => config('services.demo_accounts.customer_email'),
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_reference' => 'YIP-TEST-REFERENCE',
        ]);
    }

    public function test_customer_sees_out_of_stock_message_when_adding_to_cart(): void
    {
        $this->seed();

        $product = Product::firstOrFail();
        $product->update(['stock' => 0]);

        $this->from('/products/'.$product->slug)
            ->post('/cart/'.$product->slug, ['quantity' => 1])
            ->assertRedirect('/products/'.$product->slug)
            ->assertSessionHas('error', "{$product->name} is out of stock.");
    }

    public function test_checkout_redirects_to_cart_when_cart_item_is_out_of_stock(): void
    {
        $this->seed();

        $product = Product::firstOrFail();
        $customer = $this->customerUser();

        $this->post('/cart/'.$product->slug, ['quantity' => 1])
            ->assertRedirect('/cart');

        $product->update(['stock' => 0]);

        $this->actingAs($customer)
            ->post('/checkout', ['shipping_address' => '15 Demo Street, Lagos'])
            ->assertRedirect('/cart')
            ->assertSessionHas('error', "{$product->name} is out of stock. Please remove it from your cart.");
    }

    public function test_customer_can_track_their_orders_only(): void
    {
        $this->seed();

        $customer = $this->customerUser();
        $otherCustomer = User::factory()->create();
        $customerOrder = Order::create([
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'shipping_address' => '15 Demo Street, Lagos',
            'status' => 'processing',
            'payment_status' => 'paid',
            'payment_reference' => 'YIP-CUSTOMER-ORDER',
            'total' => 24500,
        ]);
        $otherOrder = Order::create([
            'user_id' => $otherCustomer->id,
            'customer_name' => $otherCustomer->name,
            'customer_email' => $otherCustomer->email,
            'shipping_address' => '22 Other Street, Lagos',
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'total' => 12000,
        ]);

        $this->actingAs($customer)
            ->get('/orders')
            ->assertOk()
            ->assertSee('My Orders')
            ->assertSee('#'.$customerOrder->id)
            ->assertDontSee('#'.$otherOrder->id);

        $this->actingAs($customer)
            ->get('/orders/'.$customerOrder->id)
            ->assertOk()
            ->assertSee('Order #'.$customerOrder->id);

        $this->actingAs($customer)
            ->get('/orders/'.$otherOrder->id)
            ->assertForbidden();
    }

    public function test_authenticated_users_can_update_profile_details(): void
    {
        $this->seed();

        $customer = $this->customerUser();

        $this->actingAs($customer)
            ->get('/profile')
            ->assertOk()
            ->assertSee('Update your name and email address.');

        $this->actingAs($customer)
            ->patch('/profile', [
                'name' => 'Updated Customer',
                'email' => 'updated.customer@example.com',
            ])
            ->assertRedirect()
            ->assertSessionHas('success', 'Profile updated successfully.');

        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'name' => 'Updated Customer',
            'email' => 'updated.customer@example.com',
        ]);
    }

    public function test_profile_email_must_be_valid_and_unique(): void
    {
        $this->seed();

        $customer = $this->customerUser();
        $admin = $this->adminUser();

        $this->actingAs($customer)
            ->from('/profile')
            ->patch('/profile', [
                'name' => 'Customer',
                'email' => 'not-an-email',
            ])
            ->assertRedirect('/profile')
            ->assertSessionHasErrors('email');

        $this->actingAs($customer)
            ->from('/profile')
            ->patch('/profile', [
                'name' => 'Customer',
                'email' => $admin->email,
            ])
            ->assertRedirect('/profile')
            ->assertSessionHasErrors('email');
    }

    public function test_registration_warns_about_real_email_and_rejects_fake_domains(): void
    {
        $this->get('/register')
            ->assertOk()
            ->assertSee('Use a real, active email address.');

        $this->from('/register')
            ->post('/register', [
                'name' => 'Fake Email User',
                'email' => 'person@fake-domain-not-real.invalid',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ])
            ->assertRedirect('/register')
            ->assertSessionHasErrors('email');
    }

    public function test_admin_can_view_orders_dashboard(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $order = Order::create([
            'user_id' => $admin->id,
            'customer_name' => 'Demo Customer',
            'customer_email' => config('services.demo_accounts.customer_email'),
            'shipping_address' => '15 Demo Street, Lagos',
            'status' => 'pending',
            'payment_status' => 'paid',
            'payment_reference' => 'YIP-ADMIN-ORDER',
            'total' => 24500,
        ]);

        $this->actingAs($admin)
            ->get('/admin/orders')
            ->assertOk()
            ->assertSee('Admin Orders')
            ->assertSee('View');

        $this->actingAs($admin)
            ->get('/admin/orders/'.$order->id)
            ->assertOk()
            ->assertSee('Order #'.$order->id)
            ->assertSee('Payment Details');

        $this->actingAs($admin)
            ->get('/admin/payments')
            ->assertOk()
            ->assertSee('Payment History')
            ->assertSee('YIP-ADMIN-ORDER')
            ->assertSee('View Order');
    }

    public function test_admin_can_create_product_with_multiple_images(): void
    {
        $this->seed();

        $admin = $this->adminUser();

        $this->mock(CloudinaryUploader::class, function ($mock): void {
            $mock->shouldReceive('upload')
                ->twice()
                ->andReturn(
                    ['url' => 'https://res.cloudinary.com/demo/image/upload/product-one.jpg', 'public_id' => 'product-one'],
                    ['url' => 'https://res.cloudinary.com/demo/image/upload/product-two.jpg', 'public_id' => 'product-two'],
                );
        });

        $this->actingAs($admin)
            ->post('/admin/products', [
                'name' => 'Cloud Product',
                'description' => 'A product created through the admin product form.',
                'price' => 15000,
                'stock' => 5,
                'images' => [
                    UploadedFile::fake()->image('front.jpg'),
                    UploadedFile::fake()->image('back.jpg'),
                ],
            ])
            ->assertRedirect('/admin/products');

        $product = Product::where('slug', 'cloud-product')->firstOrFail();

        $this->assertSame('https://res.cloudinary.com/demo/image/upload/product-one.jpg', $product->image_url);
        $this->assertCount(2, $product->images);
    }

    public function test_admin_products_are_searchable_and_paginated(): void
    {
        $this->seed();

        $admin = $this->adminUser();

        for ($index = 1; $index <= 12; $index++) {
            Product::create([
                'name' => 'Paged Product '.$index,
                'slug' => 'paged-product-'.$index,
                'description' => 'Extra product for pagination.',
                'price' => 1000 + $index,
                'stock' => 4,
                'image_url' => 'https://example.com/product.jpg',
                'is_active' => $index !== 12,
            ]);
        }

        $this->actingAs($admin)
            ->get('/admin/products')
            ->assertOk()
            ->assertSee('Showing 1 - 10')
            ->assertSee('Next');

        $this->actingAs($admin)
            ->get('/admin/products?search=Paged+Product+12')
            ->assertOk()
            ->assertSee('Paged Product 12')
            ->assertDontSee('Paged Product 11');

        $this->actingAs($admin)
            ->get('/admin/products?status=inactive')
            ->assertOk()
            ->assertSee('Paged Product 12')
            ->assertSee('Inactive');
    }

    public function test_admin_cannot_create_duplicate_product_names(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $existingProduct = Product::firstOrFail();

        $this->actingAs($admin)
            ->from('/admin/products/create')
            ->post('/admin/products', [
                'name' => $existingProduct->name,
                'description' => 'A duplicate product should not be created.',
                'price' => 15000,
                'stock' => 5,
                'images' => [
                    UploadedFile::fake()->image('front.jpg'),
                ],
            ])
            ->assertRedirect('/admin/products/create')
            ->assertSessionHasErrors('name');
    }

    public function test_admin_can_update_product_and_add_images(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $product = Product::with('images')->firstOrFail();

        $this->mock(CloudinaryUploader::class, function ($mock): void {
            $mock->shouldReceive('upload')
                ->once()
                ->andReturn(['url' => 'https://res.cloudinary.com/demo/image/upload/new-image.jpg', 'public_id' => 'new-image']);
        });

        $this->actingAs($admin)
            ->patch('/admin/products/'.$product->slug, [
                'name' => 'Updated Product Name',
                'description' => 'Updated product description.',
                'price' => 22000,
                'stock' => 12,
                'is_active' => 1,
                'images' => [
                    UploadedFile::fake()->image('new.jpg'),
                ],
            ])
            ->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'name' => 'Updated Product Name',
            'slug' => 'updated-product-name',
            'stock' => 12,
        ]);

        $this->assertDatabaseHas('product_images', [
            'url' => 'https://res.cloudinary.com/demo/image/upload/new-image.jpg',
            'public_id' => 'new-image',
        ]);
    }

    public function test_admin_product_view_is_read_only_and_public_product_has_no_update_button(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $customer = $this->customerUser();
        $product = Product::firstOrFail();

        $this->actingAs($admin)
            ->get('/admin/products/'.$product->slug)
            ->assertOk()
            ->assertSee('View Product')
            ->assertSee('Update');

        $this->actingAs($customer)
            ->get('/products/'.$product->slug)
            ->assertOk()
            ->assertSee('Add to Cart')
            ->assertDontSee('Updating product..');
    }

    public function test_admin_and_customer_resources_are_separated(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $customer = $this->customerUser();
        $product = Product::firstOrFail();

        $this->actingAs($admin)->get('/')->assertForbidden();
        $this->actingAs($admin)->get('/cart')->assertForbidden();
        $this->actingAs($admin)->get('/products/'.$product->slug)->assertForbidden();

        $this->actingAs($customer)->get('/admin/products')->assertForbidden();
        $this->actingAs($customer)->get('/admin/orders')->assertForbidden();
        $this->actingAs($customer)->get('/admin/payments')->assertForbidden();
    }

    public function test_paystack_callback_marks_order_as_paid(): void
    {
        $this->seed();

        $customer = $this->customerUser();
        $order = Order::create([
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'shipping_address' => '15 Demo Street, Lagos',
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_reference' => 'YIP-VERIFY-REFERENCE',
            'total' => 24500,
        ]);

        $this->mock(PaystackPayment::class, function ($mock): void {
            $mock->shouldReceive('verify')
                ->once()
                ->with('YIP-VERIFY-REFERENCE')
                ->andReturn([
                    'status' => 'success',
                    'amount' => 2450000,
                    'reference' => 'YIP-VERIFY-REFERENCE',
                ]);
        });

        $this->actingAs($customer)
            ->get('/checkout/paystack/callback?reference=YIP-VERIFY-REFERENCE')
            ->assertRedirect('/orders/'.$order->id);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'processing',
            'payment_status' => 'paid',
        ]);
    }

    public function test_admin_can_delete_product_image_and_product(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $product = Product::with('images')->firstOrFail();
        $image = $product->images->firstOrFail();

        $this->mock(CloudinaryUploader::class, function ($mock): void {
            $mock->shouldReceive('destroy')->times(3);
        });

        $this->actingAs($admin)
            ->delete('/admin/products/'.$product->slug.'/images/'.$image->id)
            ->assertRedirect();

        $this->assertDatabaseMissing('product_images', [
            'id' => $image->id,
        ]);

        $this->actingAs($admin)
            ->delete('/admin/products/'.$product->fresh()->slug)
            ->assertRedirect('/admin/products');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_admin_cannot_delete_product_that_has_been_ordered(): void
    {
        $this->seed();

        $admin = $this->adminUser();
        $product = Product::firstOrFail();
        $order = Order::create([
            'user_id' => $admin->id,
            'customer_name' => 'Demo Customer',
            'customer_email' => config('services.demo_accounts.customer_email'),
            'shipping_address' => '15 Demo Street, Lagos',
            'status' => 'pending',
            'total' => 24500,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => 1,
            'line_total' => $product->price,
        ]);

        $this->actingAs($admin)
            ->from('/admin/products')
            ->delete('/admin/products/'.$product->slug)
            ->assertRedirect('/admin/products')
            ->assertSessionHas('error', 'This product has been ordered and cannot be deleted.');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
        ]);
    }

    private function adminUser(): User
    {
        return User::where('email', config('services.demo_accounts.admin_email'))->firstOrFail();
    }

    private function customerUser(): User
    {
        return User::where('email', config('services.demo_accounts.customer_email'))->firstOrFail();
    }
}
