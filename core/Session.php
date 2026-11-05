<?php
declare(strict_types=1);

namespace Core;

/**
 * Güvenli Oturum Yöneticisi
 * Session Fixation, Hijacking korumalı, HTTPOnly & SameSite bayraklı.
 */
class Session
{
    private static bool $started = false;

    public static function start(): void
    {
        if (self::$started || session_status() === PHP_SESSION_ACTIVE) {
            self::$started = true;
            return;
        }

        $isHttps = (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
            ($_SERVER['SERVER_PORT'] ?? 80) == 443 ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        );

        $secureConfig = Env::get('COOKIE_SECURE', 'auto');
        $cookieSecure = ($secureConfig === 'auto') ? $isHttps : (bool)$secureConfig;

        $sessionLifetime = (int) Env::get('SESSION_LIFETIME', 7200);
        $sessionName = (string) Env::get('SESSION_NAME', 'fizyo_session');

        ini_set('session.use_only_cookies', '1');
        ini_set('session.use_trans_sid', '0');
        ini_set('session.cookie_httponly', '1');

        session_name($sessionName);

        session_set_cookie_params([
            'lifetime' => $sessionLifetime,
            'path'     => '/',
            'domain'   => '',
            'secure'   => $cookieSecure,
            'httponly' => true,
            'samesite' => (string) Env::get('COOKIE_SAMESITE', 'Lax')
        ]);

        session_start();
        self::$started = true;

        // Session IP ve User-Agent doğrulaması ile çalınma (hijack) kontrolü
        self::validateSessionSecurity();
    }

    private static function validateSessionSecurity(): void
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $ip = Security::getClientIp();

        if (!isset($_SESSION['_sec_ip'])) {
            $_SESSION['_sec_ip'] = $ip;
            $_SESSION['_sec_ua'] = $userAgent;
            $_SESSION['_sec_created'] = time();
        } else {
            // User-agent değiştiyse oturumu sıfırla
            if ($_SESSION['_sec_ua'] !== $userAgent) {
                self::destroy();
                self::start();
                return;
            }

            // 1 saatte bir oturum ID yenile (Session Fixation önleme)
            if (isset($_SESSION['_sec_created']) && (time() - $_SESSION['_sec_created'] > 3600)) {
                self::regenerate();
                $_SESSION['_sec_created'] = time();
            }
        }
    }

    public static function regenerate(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function setFlash(string $type, string $message): void
    {
        self::start();
        $_SESSION['_flash'][$type] = $message;
    }

    public static function getFlash(string $type): ?string
    {
        self::start();
        if (isset($_SESSION['_flash'][$type])) {
            $msg = $_SESSION['_flash'][$type];
            unset($_SESSION['_flash'][$type]);
            return $msg;
        }
        return null;
    }

    public static function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }
            session_destroy();
            self::$started = false;
        }
    }
}

