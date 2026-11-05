<?php
declare(strict_types=1);

namespace Core;

/**
 * Platform Güvenlik Katmanı
 * XSS temizleme, IP tespiti, Rate Limiting ve güvenli girdi işleme.
 */
class Security
{
    /**
     * Güvenli HTML Kaçırma (XSS Önleme)
     */
    public static function escape(?string $value): string
    {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);
    }

    /**
     * Güvenilir İstemci IP Tespiti (Proxy ve CDN spoofing korumalı)
     */
    public static function getClientIp(): string
    {
        $headers = [
            'HTTP_CF_CONNECTING_IP', // Cloudflare
            'HTTP_X_REAL_IP',        // Nginx proxy
            'HTTP_X_FORWARDED_FOR',  // Genel proxy zinciri
            'REMOTE_ADDR'
        ];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ipList = explode(',', (string)$_SERVER[$header]);
                $ip = trim($ipList[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    /**
     * Kriptografik Rastgele Güvenlik Tokenı
     */
    public static function generateRandomToken(int $bytes = 32): string
    {
        return bin2hex(random_bytes($bytes));
    }

    /**
     * Dosya Adı Sanitizasyonu (Path Traversal ve Tehlikeli Uzantı Önleme)
     */
    public static function sanitizeFileName(string $filename): string
    {
        $filename = basename($filename);
        $filename = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $filename);
        return ltrim($filename, '.');
    }

    /**
     * Basit ve Hızlı Oturum Tabanlı İstek Sınırlandırma (Rate Limiting)
     */
    public static function checkRateLimit(string $action = 'request', int $maxAttempts = 100, int $windowSeconds = 60): bool
    {
        Session::start();
        $key = "_rate_{$action}";
        $currentTime = time();

        $rateData = Session::get($key, ['count' => 0, 'first_attempt' => $currentTime]);

        if (($currentTime - $rateData['first_attempt']) > $windowSeconds) {
            // Pencere süresi doldu, sıfırla
            Session::set($key, ['count' => 1, 'first_attempt' => $currentTime]);
            return true;
        }

        if ($rateData['count'] >= $maxAttempts) {
            return false;
        }

        $rateData['count']++;
        Session::set($key, $rateData);
        return true;
    }
}

