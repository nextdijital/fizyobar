<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;
use Core\Security;

/**
 * Temel Denetleyici (Base Controller)
 */
abstract class Controller
{
    protected function render(string $view, array $data = [], bool $withLayout = true): void
    {
        View::render($view, $data, $withLayout);
    }

    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    protected function redirect(string $url, int $statusCode = 302): void
    {
        header("Location: {$url}", true, $statusCode);
        exit;
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        $value = $_POST[$key] ?? $_GET[$key] ?? $default;
        if (is_string($value)) {
            return trim($value);
        }
        return $value;
    }
}

