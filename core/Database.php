<?php
declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;
use Core\Env;

/**
 * Güvenli PDO Veritabanı Yöneticisi (Singleton)
 * PHP 8.2+ uyumlu, SQL Injection korumalı, UTF-8 mb4 destekli.
 */
class Database
{
    private static ?PDO $instance = null;
    private static bool $connectionFailed = false;
    private static ?string $lastError = null;

    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): ?PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        if (self::$connectionFailed) {
            return null;
        }

        $host = (string) Env::get('DB_HOST', '127.0.0.1');
        $port = (string) Env::get('DB_PORT', '3306');
        $dbname = (string) Env::get('DB_DATABASE', 'fizyobar_db');
        $username = (string) Env::get('DB_USERNAME', 'root');
        $password = (string) Env::get('DB_PASSWORD', '');
        $charset = (string) Env::get('DB_CHARSET', 'utf8mb4');
        $collation = (string) Env::get('DB_COLLATION', 'utf8mb4_unicode_ci');

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '{$charset}' COLLATE '{$collation}'",
        ];

        try {
            self::$instance = new PDO($dsn, $username, $password, $options);
            return self::$instance;
        } catch (PDOException $e) {
            self::$connectionFailed = true;
            self::$lastError = $e->getMessage();
            error_log('[Fizyobar DB Error] ' . $e->getMessage());

            if (Env::get('APP_DEBUG', false) && php_sapi_name() === 'cli') {
                echo "DB Connection Warning: " . $e->getMessage() . PHP_EOL;
            }

            return null;
        }
    }

    public static function isConnected(): bool
    {
        return self::getConnection() !== null;
    }

    public static function getLastError(): ?string
    {
        return self::$lastError;
    }

    /**
     * Güvenli parametreli sorgu çalıştırma yardımcısı
     */
    public static function query(string $sql, array $params = []): array
    {
        $db = self::getConnection();
        if ($db === null) {
            return [];
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Tekil satır getirme
     */
    public static function fetch(string $sql, array $params = []): ?array
    {
        $db = self::getConnection();
        if ($db === null) {
            return null;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Veri ekleme/güncelleme/silme işlemi
     */
    public static function execute(string $sql, array $params = []): bool
    {
        $db = self::getConnection();
        if ($db === null) {
            return false;
        }

        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Son eklenen kaydın ID'si
     */
    public static function lastInsertId(?string $name = null): string|false
    {
        return self::getConnection()?->lastInsertId($name) ?? false;
    }
}

