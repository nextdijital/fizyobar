<?php
declare(strict_types=1);

/**
 * ==============================================================================
 * Fizyobar Platform - Front Controller & Application Bootstrap
 * PHP 8.2 / 8.3 / 8.4 Uyumlu, Güvenli, Çok Dilli, Optimize Web Uygulaması
 * ==============================================================================
 */

// 1. Karakter Kodlaması ve Zaman Dilimi Ayarları
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// 2. Sınıf Otomatik Yükleyicisi (PSR-4 Uyumlu Autoloader)
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'Core\\' => __DIR__ . '/core/',
        'App\\'  => __DIR__ . '/app/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) === 0) {
            $relativeClass = substr($class, $len);
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});

// 3. Çevre Değişkenlerini (.env) Yükle
Core\Env::load(__DIR__ . '/.env');

// 4. Hata Raporlama ve Güvenlik Seviyesi Yapılandırması
$appDebug = (bool) Core\Env::get('APP_DEBUG', false);
$appEnv   = (string) Core\Env::get('APP_ENV', 'production');

if ($appDebug || $appEnv === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    if (!is_dir(__DIR__ . '/storage/logs')) {
        @mkdir(__DIR__ . '/storage/logs', 0755, true);
    }
    ini_set('error_log', __DIR__ . '/storage/logs/php_error.log');
}

date_default_timezone_set((string) Core\Env::get('APP_TIMEZONE', 'Europe/Istanbul'));

// 5. Yardımcı Fonksiyonları Dahil Et
require_once __DIR__ . '/core/helpers.php';

// 6. HTTP Güvenlik Başlıklarını Ayarla (Security Headers)
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header('Content-Type: text/html; charset=UTF-8');

// 7. Güvenli Oturumu Başlat
Core\Session::start();

// 8. Rota Tanımları (Clean Routes)
use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\MetodController;
use App\Controllers\ProgramController;
use App\Controllers\EventController;
use App\Controllers\CorporateController;
use App\Controllers\StudioController;
use App\Controllers\LegalController;
use App\Controllers\CookieController;
use App\Controllers\AuthController;
use App\Controllers\StudentController;
use App\Controllers\CheckoutController;
use App\Controllers\XpanelController;
use App\Controllers\AiChatController;

// --- Ön Yüz (Frontend Sayfaları) ---
Router::get('/', [HomeController::class, 'index']);
Router::get('/studio', [StudioController::class, 'index']);
Router::get('/recipes', [StudioController::class, 'recipes']);
Router::get('/tarifler', [StudioController::class, 'recipes']);
Router::get('/bar-kitchen', [StudioController::class, 'recipes']);
Router::get('/kitchen', [StudioController::class, 'recipes']);
Router::get('/guides', [StudioController::class, 'guides']);
Router::get('/rehberler', [StudioController::class, 'guides']);
Router::get('/plans', [StudioController::class, 'plans']);
Router::get('/beslenme-planlari', [StudioController::class, 'plans']);
Router::get('/articles', [StudioController::class, 'articles']);
Router::get('/makaleler', [StudioController::class, 'articles']);
Router::get('/blog', [StudioController::class, 'blog']);
Router::get('/programini-bul', [ProgramController::class, 'finder']);
Router::get('/find-program', [ProgramController::class, 'finder']);
Router::get('/metod', [MetodController::class, 'index']);
Router::get('/programs', [ProgramController::class, 'index']);
Router::get('/detox', [ProgramController::class, 'detox']);
Router::get('/detox-kampi', [ProgramController::class, 'detox']);
Router::get('/online-detox', [ProgramController::class, 'detox']);
Router::get('/events', [EventController::class, 'index']);
Router::get('/etkinlikler', [EventController::class, 'index']);
Router::get('/duyurular', [EventController::class, 'announcements']);
Router::get('/announcements', [EventController::class, 'announcements']);
Router::get('/haberler', [EventController::class, 'news']);
Router::get('/news', [EventController::class, 'news']);
Router::get('/corporate', [CorporateController::class, 'index']);
Router::get('/betina-tansug', [CorporateController::class, 'about']);
Router::get('/about', [CorporateController::class, 'about']);
Router::get('/hakkimizda', [CorporateController::class, 'about']);
Router::post('/corporate/submit', [CorporateController::class, 'submit']);

// Yasal & Gizlilik Politikaları (Bilingual /tr/... ve /en/...)
Router::get('/privacy', [LegalController::class, 'privacy']);
Router::get('/terms', [LegalController::class, 'terms']);
Router::get('/cookies', [LegalController::class, 'cookies']);
Router::get('/kvkk', [LegalController::class, 'kvkk']);
Router::get('/refund', [LegalController::class, 'refund']);

// --- Kullanıcı Kimlik Doğrulama (Auth) ---
Router::get('/login', [AuthController::class, 'login']);
Router::post('/login/process', [AuthController::class, 'loginProcess']);
Router::get('/register', [AuthController::class, 'register']);
Router::post('/register/process', [AuthController::class, 'registerProcess']);
Router::get('/logout', [AuthController::class, 'logout']);
Router::get('/forgot-password', [AuthController::class, 'forgotPassword']);
Router::post('/forgot-password/process', [AuthController::class, 'forgotPasswordProcess']);
Router::get('/reset-password/{token}', [AuthController::class, 'resetPassword']);
Router::post('/reset-password/process', [AuthController::class, 'resetPasswordProcess']);

// --- Öğrenci Paneli & Movement Space (Kişisel Hareket Alanı) ---
Router::get('/dashboard', [StudentController::class, 'dashboard']);
Router::get('/movement-space', [StudentController::class, 'dashboard']);
Router::get('/course/{slug}', [StudentController::class, 'viewCourse']);
Router::get('/course/{slug}/lesson/{id}', [StudentController::class, 'viewLesson']);
Router::post('/api/lesson/complete', [StudentController::class, 'completeLesson']);
Router::post('/api/movement/toggle-mode', [StudentController::class, 'toggleLockMode']);
Router::post('/api/profile/update', [StudentController::class, 'updateProfile']);
Router::post('/api/profile/password', [StudentController::class, 'changePassword']);

// --- Satın Alma & IBAN Havale Ödeme Bildirimi ---
Router::get('/checkout/{id}', [CheckoutController::class, 'checkout']);
Router::post('/checkout/{id}/submit-iban', [CheckoutController::class, 'submitIban']);
Router::get('/checkout/success/{id}', [CheckoutController::class, 'success']);

// --- Çerez Tercihleri AJAX API Rotası ---
Router::post('/api/cookie-preferences', [CookieController::class, 'savePreferences']);

// --- Yapay Zeka AI Chat Asistanı & Programını Bul API Rotaları ---
Router::post('/api/ai-chat', [AiChatController::class, 'chat']);
Router::get('/api/ai-chat', [AiChatController::class, 'chat']);
Router::post('/api/find-program-ai', [AiChatController::class, 'recommendProgram']);
Router::get('/api/find-program-ai', [AiChatController::class, 'recommendProgram']);

// --- XPANEL YÖNETİM MERKEZİ (Ayrı & Güvenli Admin Girişi) ---
Router::get('/xpanel/login', [XpanelController::class, 'login']);
Router::post('/xpanel/login/process', [XpanelController::class, 'loginProcess']);
Router::get('/xpanel/logout', [XpanelController::class, 'logout']);
Router::get('/xpanel', [XpanelController::class, 'index']);
Router::get('/xpanel/settings', [XpanelController::class, 'settings']);
Router::post('/xpanel/settings/save', [XpanelController::class, 'updateSettings']);
Router::get('/xpanel/courses', [XpanelController::class, 'courses']);
Router::post('/xpanel/courses/save', [XpanelController::class, 'saveCourse']);
Router::post('/xpanel/courses/delete', [XpanelController::class, 'deleteCourse']);
Router::get('/xpanel/courses/{id}/lessons', [XpanelController::class, 'lessons']);
Router::post('/xpanel/lessons/save', [XpanelController::class, 'saveLesson']);
Router::post('/xpanel/lessons/delete', [XpanelController::class, 'deleteLesson']);
Router::get('/xpanel/enrollments', [XpanelController::class, 'enrollments']);
Router::post('/xpanel/enrollments/save', [XpanelController::class, 'saveEnrollment']);
Router::post('/xpanel/enrollments/delete', [XpanelController::class, 'deleteEnrollment']);
Router::post('/xpanel/enrollments/approve', [XpanelController::class, 'approveEnrollment']);
Router::post('/xpanel/enrollments/reject', [XpanelController::class, 'rejectEnrollment']);
Router::get('/xpanel/users', [XpanelController::class, 'users']);
Router::post('/xpanel/users/status', [XpanelController::class, 'updateUserStatus']);
Router::post('/xpanel/users/role', [XpanelController::class, 'updateUserRole']);
Router::post('/xpanel/users/password', [XpanelController::class, 'resetUserPassword']);
Router::post('/xpanel/users/delete', [XpanelController::class, 'deleteUser']);
Router::post('/xpanel/users/enroll', [XpanelController::class, 'enrollUser']);

// Studio & İçerik Yönetimi (Tarifler, Rehberler, Mikro Rutinler)
Router::get('/xpanel/nutrition', [XpanelController::class, 'nutrition']);
Router::post('/xpanel/nutrition/save', [XpanelController::class, 'saveNutrition']);
Router::post('/xpanel/nutrition/delete', [XpanelController::class, 'deleteNutrition']);

// 9. İstek Dağıtımı (Dispatch)
Router::dispatch();
