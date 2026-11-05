<?php
declare(strict_types=1);

namespace Core;

/**
 * Kullanıcı Kimlik Doğrulama & Yetkilendirme Yöneticisi
 */
class Auth
{
    private const SESSION_KEY = '_auth_user_id';

    public static function check(): bool
    {
        Session::start();
        return Session::has(self::SESSION_KEY);
    }

    public static function id(): ?int
    {
        Session::start();
        return Session::get(self::SESSION_KEY);
    }

    public static function user(): ?array
    {
        $id = self::id();
        if (!$id) {
            return null;
        }

        return Database::fetch("SELECT id, full_name, email, phone, role, status FROM users WHERE id = ?", [$id]);
    }

    public static function isAdmin(): bool
    {
        $user = self::user();
        return $user && ($user['role'] === 'admin');
    }

    public static function login(int $userId): void
    {
        Session::start();
        Session::regenerate();
        Session::set(self::SESSION_KEY, $userId);
    }

    public static function logout(): void
    {
        Session::start();
        Session::remove(self::SESSION_KEY);
        Session::regenerate();
    }
}

