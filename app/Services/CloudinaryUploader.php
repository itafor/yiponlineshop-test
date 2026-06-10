<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CloudinaryUploader
{
    /**
     * @return array{url: string, public_id: string|null}
     */
    public function upload(UploadedFile $file, string $folder = 'yiponline/products'): array
    {
        $config = $this->credentials();
        $timestamp = time();
        $params = [
            'folder' => $folder,
            'timestamp' => $timestamp,
        ];

        $signature = $this->signature($params, $config['api_secret']);

        $response = Http::timeout(30)->retry(2, 300)->attach(
            'file',
            fopen($file->getRealPath(), 'r'),
            $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$config['cloud_name']}/image/upload", [
            'api_key' => $config['api_key'],
            'folder' => $folder,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        if (! $response->successful()) {
            throw new RuntimeException('Cloudinary upload failed: '.$response->body());
        }

        return [
            'url' => $response->json('secure_url'),
            'public_id' => $response->json('public_id'),
        ];
    }

    public function destroy(?string $publicId): void
    {
        if (! $publicId) {
            return;
        }

        $config = $this->credentials();
        $timestamp = time();
        $params = [
            'public_id' => $publicId,
            'timestamp' => $timestamp,
        ];

        $signature = $this->signature($params, $config['api_secret']);

        Http::timeout(15)->post("https://api.cloudinary.com/v1_1/{$config['cloud_name']}/image/destroy", [
            'api_key' => $config['api_key'],
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);
    }

    /**
     * @return array{api_key: string, api_secret: string, cloud_name: string}
     */
    private function credentials(): array
    {
        $url = config('services.cloudinary.url');

        if (! $url) {
            throw new RuntimeException('CLOUDINARY_URL is not configured.');
        }

        $parts = parse_url($url);

        if (! $parts || empty($parts['user']) || empty($parts['pass']) || empty($parts['host'])) {
            throw new RuntimeException('CLOUDINARY_URL must follow cloudinary://api_key:api_secret@cloud_name.');
        }

        return [
            'api_key' => $parts['user'],
            'api_secret' => $parts['pass'],
            'cloud_name' => $parts['host'],
        ];
    }

    /**
     * @param array<string, string|int> $params
     */
    private function signature(array $params, string $apiSecret): string
    {
        ksort($params);

        $payload = collect($params)
            ->map(fn ($value, $key) => $key.'='.$value)
            ->implode('&');

        return sha1($payload.$apiSecret);
    }
}
