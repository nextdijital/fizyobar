<?php
declare(strict_types=1);

namespace Core;

/**
 * Görünüm (View) ve Şablon Motoru
 * Güvenli değişken kaçırma, otomatik başlık/altlık ekleme ve evrensel yardımcılar.
 */
class View
{
    private static string $viewsPath = __DIR__ . '/../app/Views/';

    public static function render(string $view, array $data = [], bool $withLayout = true): void
    {
        $viewFile = self::$viewsPath . ltrim($view, '/') . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "View file not found: " . Security::escape($view);
            return;
        }

        // Genel değişkenleri ve yardımcıları görünüme hazırla
        $globalData = [
            'appName'       => (string) Env::get('APP_NAME', 'Fizyobar'),
            'currentLang'   => Language::current(),
            'isTr'          => Language::isTr(),
            'isEn'          => Language::isEn(),
            'csrfToken'     => Csrf::token(),
            'csrfField'     => Csrf::field(),
            'csrfMeta'      => Csrf::metaTag(),
            'basePath'      => Router::getBasePath(),
            'currentUri'    => Router::getCurrentUri(),
        ];

        $mergedData = array_merge($globalData, $data);
        extract($mergedData);

        if ($withLayout) {
            $headerFile = self::$viewsPath . 'layouts/header.php';
            $footerFile = self::$viewsPath . 'layouts/footer.php';

            if (file_exists($headerFile)) {
                require $headerFile;
            }

            require $viewFile;

            if (file_exists($footerFile)) {
                require $footerFile;
            }
        } else {
            require $viewFile;
        }
    }
}

