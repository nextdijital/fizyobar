<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Security;

class CookieController extends Controller
{
    public function savePreferences(): void
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? $_POST;

        $analytics = !empty($data['analytics']);
        $marketing = !empty($data['marketing']);
        $necessary = true; // Zorunlu çerezler her zaman aktiftir

        $cookieValue = json_encode([
            'necessary' => $necessary,
            'analytics' => $analytics,
            'marketing' => $marketing,
            'timestamp' => time(),
            'version'   => 1
        ], JSON_UNESCAPED_SLASHES);

        // 1 yıl süreli KVKK/GDPR çerezi
        setcookie('fizyo_cookie_consent', (string)$cookieValue, [
            'expires'  => time() + (86400 * 365),
            'path'     => '/',
            'httponly' => false, // JS tarafından okunabilmesi için
            'samesite' => 'Lax'
        ]);

        $this->json([
            'success' => true,
            'message' => 'Preferences saved successfully',
            'preferences' => [
                'necessary' => $necessary,
                'analytics' => $analytics,
                'marketing' => $marketing,
            ]
        ]);
    }
}

