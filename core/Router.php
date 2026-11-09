<?php
declare(strict_types=1);

namespace Core;

/**
 * Temiz URL & Rota Yöneticisi
 * Çok dilli URL desteği (/tr/..., /en/...), alt dizin (XAMPP localhost/fizyobar) ve root alan adı uyumu.
 */
class Router
{
    private static array $routes = [
        'GET'  => [],
        'POST' => []
    ];

    private static ?string $basePath = null;

    public static function get(string $path, array|callable $handler): void
    {
        self::$routes['GET'][$path] = $handler;
    }

    public static function post(string $path, array|callable $handler): void
    {
        self::$routes['POST'][$path] = $handler;
    }

    /**
     * Otomatik Taban URL Yolunu Tespit Et (örn: /fizyobar veya "")
     */
    public static function getBasePath(): string
    {
        if (self::$basePath !== null) {
            return self::$basePath;
        }

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $dir = str_replace('\\', '/', dirname($scriptName));
        self::$basePath = ($dir === '/' || $dir === '.') ? '' : rtrim($dir, '/');

        return self::$basePath;
    }

    /**
     * Temiz URL Oluşturucu (Alt dizin ve aktif dil ön ekini otomatik ekler)
     */
    public static function url(string $path = '', ?string $lang = null): string
    {
        $base = self::getBasePath();
        $targetLang = $lang ?? Language::current();
        $cleanPath = trim($path, '/');

        if ($cleanPath === '') {
            return ($base === '') ? "/{$targetLang}" : "{$base}/{$targetLang}";
        }

        // Eğer zaten dil ön eki varsa koru, yoksa ekle
        $segments = explode('/', $cleanPath);
        if (in_array($segments[0], Language::getSupported(), true)) {
            $segments[0] = $targetLang;
            $cleanPath = implode('/', $segments);
        } else {
            $cleanPath = "{$targetLang}/{$cleanPath}";
        }

        return ($base === '') ? "/{$cleanPath}" : "{$base}/{$cleanPath}";
    }

    /**
     * Dil Değiştirme URL'i üretir (Mevcut sayfayı diğer dile çevirir)
     */
    public static function switchLangUrl(string $newLang): string
    {
        $uri = self::getCurrentUri();
        $segments = explode('/', trim($uri, '/'));

        if (!empty($segments) && in_array($segments[0], Language::getSupported(), true)) {
            $segments[0] = $newLang;
            $cleanPath = implode('/', $segments);
        } else {
            $cleanPath = $newLang;
        }

        $base = self::getBasePath();
        return ($base === '') ? "/{$cleanPath}" : "{$base}/{$cleanPath}";
    }

    /**
     * Gelen isteğin göreceli URI'sini alır
     */
    public static function getCurrentUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        // Query string temizle
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode($uri);
        $base = self::getBasePath();

        if ($base !== '' && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }

        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    /**
     * Rota Çözümleme ve İstek Dağıtımı
     */
    public static function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'HEAD') {
            $method = 'GET';
        }
        $uri = self::getCurrentUri();

        // 1. Dil ön ekini, Admin (xpanel) veya API rotalarını analiz et
        $segments = explode('/', trim($uri, '/'));
        $firstSegment = $segments[0] ?? '';

        if ($firstSegment === 'api' || $firstSegment === 'xpanel') {
            // API ve xpanel rotalarında dil ön eki aranmaz, doğrudan rota işlenir
            Language::init();
            $normalizedPath = $uri;
        } elseif (in_array($firstSegment, Language::getSupported(), true)) {
            Language::init($firstSegment);
            array_shift($segments);
            $normalizedPath = '/' . implode('/', $segments);
        } else {
            // Dil ön eki yoksa varsayılan dile yönlendir
            Language::init();
            $redirectUrl = self::url($uri);
            header("Location: {$redirectUrl}", true, 302);
            exit;
        }

        // POST isteklerinde otomatik CSRF doğrulaması (Genel arama/danışma API'leri hariç)
        if ($method === 'POST') {
            $csrfExempt = ['/api/ai-chat', '/api/lesson/complete', '/api/movement/toggle-mode'];
            if (!in_array($normalizedPath, $csrfExempt, true) && !Csrf::validate()) {
                http_response_code(403);
                if ($firstSegment === 'api') {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode([
                        'success' => false,
                        'error'   => 'CSRF token mismatch or expired'
                    ]);
                    exit;
                }
                View::render('errors/419', [
                    'message' => Language::get('errors.csrf_expired', ['default' => 'Güvenlik doğrulaması süresi doldu. Lütfen sayfayı yenileyip tekrar deneyin.'])
                ]);
                exit;
            }
        }

        // Rota eşleştirme
        if (isset(self::$routes[$method][$normalizedPath])) {
            self::callHandler(self::$routes[$method][$normalizedPath]);
            return;
        }

        // Dinamik parametreli rotalar için kontrol
        foreach (self::$routes[$method] as $routePath => $handler) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $routePath);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $normalizedPath, $matches)) {
                array_shift($matches);
                self::callHandler($handler, $matches);
                return;
            }
        }

        // 404 Sayfası
        http_response_code(404);
        View::render('errors/404', [
            'title' => Language::get('errors.page_not_found')
        ]);
    }

    private static function callHandler(array|callable $handler, array $params = []): void
    {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$class, $action] = $handler;
            if (class_exists($class)) {
                $controller = new $class();
                if (method_exists($controller, $action)) {
                    call_user_func_array([$controller, $action], $params);
                    return;
                }
            }
        }

        http_response_code(500);
        echo "Controller or action not found.";
    }
}
