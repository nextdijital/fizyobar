<?php
declare(strict_types=1);

namespace Core;

/**
 * CSRF (Cross-Site Request Forgery) Koruma Modülü
 * Form tokenları ve AJAX X-CSRF-TOKEN başlık doğrulaması.
 */
class Csrf
{
    private const SESSION_KEY = '_csrf_token';

    public static function token(): string
    {
        Session::start();
        $token = Session::get(self::SESSION_KEY);

        if (!$token || !is_string($token)) {
            $token = bin2hex(random_bytes(32));
            Session::set(self::SESSION_KEY, $token);
        }

        return $token;
    }

    public static function field(): string
    {
        $token = self::token();
        return '<input type="hidden" name="_csrf_token" value="' . Security::escape($token) . '">';
    }

    public static function metaTag(): string
    {
        $token = self::token();
        return '<meta name="csrf-token" content="' . Security::escape($token) . '">';
    }

    public static function validate(?string $submittedToken = null): bool
    {
        Session::start();
        $storedToken = Session::get(self::SESSION_KEY);

        if (!$storedToken || !is_string($storedToken)) {
            return false;
        }

        // Eğer parametre verilmediyse POST gövdesi veya AJAX başlığından al
        if ($submittedToken === null) {
            $submittedToken = $_POST['_csrf_token']
                ?? $_SERVER['HTTP_X_CSRF_TOKEN']
                ?? $_SERVER['HTTP_X_XSRF_TOKEN']
                ?? null;

            if ($submittedToken === null) {
                $raw = @file_get_contents('php://input');
                if ($raw) {
                    $json = @json_decode($raw, true);
                    if (is_array($json) && !empty($json['_csrf_token'])) {
                        $submittedToken = $json['_csrf_token'];
                    }
                }
            }
        }

        if (!is_string($submittedToken)) {
            return false;
        }

        return hash_equals($storedToken, $submittedToken);
    }

    public static function regenerate(): string
    {
        Session::start();
        $newToken = bin2hex(random_bytes(32));
        Session::set(self::SESSION_KEY, $newToken);
        return $newToken;
    }
}

