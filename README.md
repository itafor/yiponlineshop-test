# YipOnline E-commerce Case Study

A Laravel 12 e-commerce case study built for the PHP Full Stack Developer task. The app uses Laravel structure, Eloquent, MySQL, session cart behavior, and Smarty templates for the UI layer.

## Features

- Product listing and product detail pages
- Shopping cart with add, update, and remove actions
- Authenticated checkout
- User registration, login, and logout
- Admin order dashboard with status updates
- Admin product creation with multiple Cloudinary image uploads
- Product detail gallery with active image and thumbnails
- Mobile-responsive storefront and dashboard CSS
- Smarty-powered templates in `resources/smarty`

## Demo Accounts

- Admin: `admin@yiponline.test` / `password123`
- Customer: `customer@yiponline.test` / `password123`

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open `http://127.0.0.1:8000`.

The default database is MySQL:

```env
DB_DATABASE=viponlineshop
DB_USERNAME=root
DB_PASSWORD=
```

Cloudinary uploads use:

```env
CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name
```

On Windows PowerShell, if `npm` is blocked by execution policy, use `npm.cmd` instead. This project does not require a frontend build step because the case-study CSS is plain CSS in `public/css/app.css`.

## Test

```bash
php artisan test
```

Current coverage includes storefront rendering, product detail rendering, cart checkout flow, admin order dashboard access, and admin product creation with multiple mocked Cloudinary uploads.

## Smarty Integration

Smarty is installed through Composer with `smarty/smarty`. The small integration service lives at `app/Services/SmartyRenderer.php` and renders `.tpl` files from `resources/smarty`.
