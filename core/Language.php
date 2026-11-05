<?php
declare(strict_types=1);

namespace Core;

/**
 * Çok Dilli Sistem (i18n) Motoru - TR / EN
 * Diller asla birbirine karışmaz. UTF-8 tam uyumludur.
 */
class Language
{
    private static string $currentLang = 'tr';
    private static array $supportedLangs = ['tr', 'en'];
    private static array $translations = [];
    private static array $fallbackTranslations = [];

    public static function init(?string $requestedLang = null): void
    {
        $defaultLang = (string) Env::get('APP_DEFAULT_LANG', 'tr');
        $fallbackLang = (string) Env::get('APP_FALLBACK_LANG', 'en');

        // Dil belirleme önceliği:
        // 1. Doğrudan parametre (URL ön eki /tr/ veya /en/)
        // 2. Oturumdaki dil tercihi
        // 3. Çerezdeki dil tercihi
        // 4. Tarayıcı Accept-Language başlığı
        // 5. Varsayılan dil (tr)
        if ($requestedLang && in_array($requestedLang, self::$supportedLangs, true)) {
            self::$currentLang = $requestedLang;
        } elseif (Session::has('_lang') && in_array(Session::get('_lang'), self::$supportedLangs, true)) {
            self::$currentLang = Session::get('_lang');
        } elseif (isset($_COOKIE['fizyo_lang']) && in_array($_COOKIE['fizyo_lang'], self::$supportedLangs, true)) {
            self::$currentLang = $_COOKIE['fizyo_lang'];
        } else {
            self::$currentLang = self::detectBrowserLanguage($defaultLang);
        }

        // Seçilen dili oturuma ve çereze kaydet
        Session::set('_lang', self::$currentLang);
        if (!isset($_COOKIE['fizyo_lang']) || $_COOKIE['fizyo_lang'] !== self::$currentLang) {
            @setcookie('fizyo_lang', self::$currentLang, [
                'expires'  => time() + (86400 * 365),
                'path'     => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }

        // Ana dil sözlüğünü yükle
        self::$translations = self::loadLanguageFile(self::$currentLang);

        // İhtiyaç halinde kullanılmak üzere yedek dil sözlüğünü yükle
        if (self::$currentLang !== $defaultLang) {
            self::$fallbackTranslations = self::loadLanguageFile($defaultLang);
        }
    }

    private static function detectBrowserLanguage(string $default): string
    {
        if (empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return $default;
        }

        $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        foreach ($langs as $lang) {
            $code = strtolower(substr(trim($lang), 0, 2));
            if (in_array($code, self::$supportedLangs, true)) {
                return $code;
            }
        }

        return $default;
    }

    private static function loadLanguageFile(string $code): array
    {
        $file = __DIR__ . "/../languages/{$code}.php";
        if (file_exists($file)) {
            $data = include $file;
            return is_array($data) ? $data : [];
        }
        return [];
    }

    public static function get(string $key, array $replace = []): string
    {
        $keys = explode('.', $key);
        $value = self::findInArray(self::$translations, $keys);

        // Ana dilde bulunamadıysa yedek dilden ara
        if ($value === null && !empty(self::$fallbackTranslations)) {
            $value = self::findInArray(self::$fallbackTranslations, $keys);
        }

        // Hala bulunamadıysa anahtarın kendisini döndür
        if ($value === null) {
            return $key;
        }

        // Değişkenleri yerleştir (:name => 'Fizyobar')
        foreach ($replace as $placeholder => $val) {
            $value = str_replace(':' . $placeholder, (string)$val, $value);
        }

        return $value;
    }

    private static function findInArray(array $array, array $keys): ?string
    {
        $current = $array;
        foreach ($keys as $k) {
            if (!isset($current[$k])) {
                return null;
            }
            $current = $current[$k];
        }

        return is_string($current) ? $current : null;
    }

    public static function current(): string
    {
        return self::$currentLang;
    }

    public static function isTr(): bool
    {
        return self::$currentLang === 'tr';
    }

    public static function isEn(): bool
    {
        return self::$currentLang === 'en';
    }

    public static function getSupported(): array
    {
        return self::$supportedLangs;
    }

    public static function setLanguage(string $lang): void
    {
        if (in_array($lang, self::$supportedLangs, true)) {
            self::$currentLang = $lang;
            Session::set('_lang', $lang);
            @setcookie('fizyo_lang', $lang, [
                'expires'  => time() + (86400 * 365),
                'path'     => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            self::$translations = self::loadLanguageFile($lang);
        }
    }
}

