<?php
declare(strict_types=1);

use Core\Language;
use Core\Router;
use Core\Security;
use Core\Csrf;
use Core\ImageOptimizer;
use Core\Auth;
use Core\Setting;

if (!function_exists('__')) {
    function __(string $key, array $replace = []): string
    {
        return Language::get($key, $replace);
    }
}

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return Security::escape($value);
    }
}

if (!function_exists('url')) {
    function url(string $path = '', ?string $lang = null): string
    {
        return Router::url($path, $lang);
    }
}

if (!function_exists('switch_lang_url')) {
    function switch_lang_url(string $lang): string
    {
        return Router::switchLangUrl($lang);
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $base = Router::getBasePath();
        $cleanPath = ltrim($path, '/');
        $fullPath = __DIR__ . '/../' . $cleanPath;

        $version = file_exists($fullPath) ? filemtime($fullPath) : 1;
        $url = ($base === '') ? "/{$cleanPath}" : "{$base}/{$cleanPath}";

        return "{$url}?v={$version}";
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return Csrf::field();
    }
}

if (!function_exists('csrf_meta')) {
    function csrf_meta(): string
    {
        return Csrf::metaTag();
    }
}

if (!function_exists('webp_picture')) {
    function webp_picture(string $src, string $alt = '', string $class = '', string $loading = 'lazy'): string
    {
        return ImageOptimizer::pictureTag($src, $alt, $class, $loading);
    }
}

if (!function_exists('auth_user')) {
    function auth_user(): ?array
    {
        return Auth::user();
    }
}

if (!function_exists('auth_check')) {
    function auth_check(): bool
    {
        return Auth::check();
    }
}

if (!function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('youtube_embed_url')) {
    function youtube_embed_url(string $videoId): string
    {
        return "https://www.youtube-nocookie.com/embed/" . urlencode($videoId) . "?rel=0&modestbranding=1&showinfo=0";
    }
}
