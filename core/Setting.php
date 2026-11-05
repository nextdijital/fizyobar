<?php
declare(strict_types=1);

namespace Core;

/**
 * Dinamik Site Ayarları Yöneticisi
 */
class Setting
{
    private static array $cache = [];
    private static bool $loaded = false;

    private static function loadAll(): void
    {
        if (self::$loaded) {
            return;
        }

        $rows = Database::query("SELECT `key`, `value` FROM settings");
        foreach ($rows as $row) {
            self::$cache[$row['key']] = $row['value'];
        }
        self::$loaded = true;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        self::loadAll();
        return self::$cache[$key] ?? $default;
    }

    public static function set(string $key, ?string $value): void
    {
        self::loadAll();
        self::$cache[$key] = $value;

        Database::execute(
            "INSERT INTO settings (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)",
            [$key, $value]
        );
    }

    public static function all(): array
    {
        self::loadAll();
        return self::$cache;
    }
}

