<?php
declare(strict_types=1);

namespace Core;

/**
 * WebP Otomatik Görsel Dönüştürücü ve Önbellek Yöneticisi
 * JPG, JPEG, PNG formatlarını şeffaflık kaybı olmadan WebP formatına çevirir ve önbelleğe alır.
 */
class ImageOptimizer
{
    private static string $cacheDir = __DIR__ . '/../storage/cache/webp';

    public static function init(): void
    {
        if (!is_dir(self::$cacheDir)) {
            @mkdir(self::$cacheDir, 0755, true);
        }
    }

    /**
     * Görseli WebP formatına dönüştürüp önbellek dosya yolunu döner
     */
    public static function convertToWebP(string $sourcePath, ?int $quality = null): ?string
    {
        self::init();

        if (!file_exists($sourcePath) || !is_readable($sourcePath)) {
            return null;
        }

        // GD WebP desteği kontrolü
        if (!function_exists('imagewebp')) {
            return $sourcePath; // GD desteklemiyorsa orijinali kullan
        }

        $quality = $quality ?? (int) Env::get('WEBP_QUALITY', 82);
        $fileMTime = filemtime($sourcePath);
        $hashName = md5($sourcePath . '_' . $fileMTime . '_' . $quality) . '.webp';
        $destinationPath = self::$cacheDir . '/' . $hashName;

        // Önbellekte zaten güncel hali varsa doğrudan dön
        if (file_exists($destinationPath) && filemtime($destinationPath) >= $fileMTime) {
            return $destinationPath;
        }

        $imageInfo = @getimagesize($sourcePath);
        if (!$imageInfo) {
            return null;
        }

        $mime = $imageInfo['mime'];
        $image = null;

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = @imagecreatefromjpeg($sourcePath);
                break;

            case 'image/png':
                $image = @imagecreatefrompng($sourcePath);
                if ($image) {
                    imagepalettetotruecolor($image);
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                }
                break;

            case 'image/webp':
                return $sourcePath; // Zaten webp

            default:
                return $sourcePath; // Desteklenmeyen format (örn. svg), orijinali dön
        }

        if (!$image) {
            return $sourcePath;
        }

        // WebP olarak kaydet
        $saved = imagewebp($image, $destinationPath, $quality);
        imagedestroy($image);

        return $saved ? $destinationPath : $sourcePath;
    }

    /**
     * HTML `<picture>` etiketi oluşturucu (Modern tarayıcılar için WebP + Fallback)
     */
    public static function pictureTag(
        string $src,
        string $alt = '',
        string $class = '',
        string $loading = 'lazy',
        int $quality = 82
    ): string {
        $baseUrl = rtrim((string)Env::get('APP_URL', ''), '/');
        $realPath = __DIR__ . '/../' . ltrim($src, '/');

        $webpUrl = $src;
        if (file_exists($realPath) && !str_ends_with(strtolower($src), '.svg')) {
            $webpCache = self::convertToWebP($realPath, $quality);
            if ($webpCache && file_exists($webpCache)) {
                $cacheFileName = basename($webpCache);
                $webpUrl = $baseUrl . '/storage/cache/webp/' . $cacheFileName;
            }
        }

        $originalUrl = (str_starts_with($src, 'http') || empty($baseUrl)) ? $src : $baseUrl . '/' . ltrim($src, '/');
        $altSafe = Security::escape($alt);
        $classSafe = Security::escape($class);
        $loadingSafe = Security::escape($loading);

        if (str_ends_with(strtolower($src), '.svg')) {
            return "<img src=\"{$originalUrl}\" alt=\"{$altSafe}\" class=\"{$classSafe}\" loading=\"{$loadingSafe}\">";
        }

        return "
        <picture>
            <source srcset=\"{$webpUrl}\" type=\"image/webp\">
            <img src=\"{$originalUrl}\" alt=\"{$altSafe}\" class=\"{$classSafe}\" loading=\"{$loadingSafe}\">
        </picture>";
    }
}

