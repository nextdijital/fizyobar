<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;
use Core\Security;

class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            if (Auth::isAdmin()) {
                $this->redirect(url('/xpanel'));
            }
            $this->redirect(url('/dashboard'));
        }

        $error = Session::getFlash('login_error');
        $this->render('pages/auth/login', [
            'metaTitle' => 'Giriş Yap | Fizyobar',
            'error' => $error
        ]);
    }

    public function loginProcess(): void
    {
        $email = trim((string)$this->input('email'));
        $password = (string)$this->input('password');

        if (empty($email) || empty($password)) {
            Session::setFlash('login_error', 'Lütfen e-posta ve şifrenizi giriniz.');
            $this->redirect(url('/login'));
        }

        $user = Database::fetch("SELECT * FROM users WHERE email = ?", [$email]);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            Session::setFlash('login_error', 'Geçersiz e-posta adresi veya şifre.');
            $this->redirect(url('/login'));
        }

        if ($user['status'] !== 'active') {
            Session::setFlash('login_error', 'Hesabınız askıya alınmıştır. Lütfen destekle iletişime geçiniz.');
            $this->redirect(url('/login'));
        }

        if ($user['role'] === 'admin') {
            Session::setFlash('login_error', 'Yönetici hesabı güvenlik nedeniyle bu alandan giriş yapamaz. Lütfen xpanel yönetim merkezini kullanınız.');
            $this->redirect(url('/login'));
        }

        Auth::login((int)$user['id']);
        $this->redirect(url('/dashboard'));
    }

    public function register(): void
    {
        if (Auth::check()) {
            $this->redirect(url('/dashboard'));
        }

        $error = Session::getFlash('register_error');
        $this->render('pages/auth/register', [
            'metaTitle' => 'Üye Ol | Fizyobar',
            'error' => $error
        ]);
    }

    public function registerProcess(): void
    {
        $fullName = trim((string)$this->input('full_name'));
        $email = trim((string)$this->input('email'));
        $phone = trim((string)$this->input('phone'));
        $password = (string)$this->input('password');

        if (empty($fullName) || empty($email) || empty($password)) {
            Session::setFlash('register_error', 'Lütfen zorunlu alanları eksiksiz doldurunuz.');
            $this->redirect(url('/register'));
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('register_error', 'Lütfen geçerli bir e-posta adresi giriniz.');
            $this->redirect(url('/register'));
        }

        if (strlen($password) < 6) {
            Session::setFlash('register_error', 'Şifreniz en az 6 karakter olmalıdır.');
            $this->redirect(url('/register'));
        }

        $existing = Database::fetch("SELECT id FROM users WHERE email = ?", [$email]);
        if ($existing) {
            Session::setFlash('register_error', 'Bu e-posta adresi ile zaten kayıtlı bir hesap bulunmaktadır.');
            $this->redirect(url('/register'));
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);
        Database::execute(
            "INSERT INTO users (full_name, email, phone, password_hash, role, status) VALUES (?, ?, ?, ?, 'student', 'active')",
            [$fullName, $email, $phone, $hash]
        );

        $userId = (int)Database::getConnection()->lastInsertId();
        
        // Yeni üye olan kullanıcı için otomatik Movement Space program kaydı oluştur (Course 1)
        Database::execute(
            "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, approved_at, start_date, expires_at, created_at)
             VALUES (?, 1, 'iban', 'approved', 0.00, NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 90 DAY), NOW())",
            [$userId]
        );

        Auth::login($userId);

        $this->redirect(url('/dashboard'));
    }

    public function forgotPassword(): void
    {
        if (Auth::check()) {
            $this->redirect(url('/dashboard'));
        }

        $error = Session::getFlash('forgot_error');
        $success = Session::getFlash('forgot_success');
        $resetLink = Session::getFlash('reset_link_preview');

        $this->render('pages/auth/forgot_password', [
            'metaTitle' => 'Şifremi Unuttum | Fizyobar',
            'error' => $error,
            'success' => $success,
            'resetLink' => $resetLink
        ]);
    }

    public function forgotPasswordProcess(): void
    {
        $email = trim((string)$this->input('email'));

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('forgot_error', 'Lütfen geçerli bir e-posta adresi giriniz.');
            $this->redirect(url('/forgot-password'));
        }

        $user = Database::fetch("SELECT id, email, full_name FROM users WHERE email = ? AND status = 'active'", [$email]);

        if (!$user) {
            // Güvenlik gereği kullanıcı yoksa bile genel mesaj verilir
            Session::setFlash('forgot_success', 'Eğer bu e-posta adresi sistemimizde kayıtlı ise şifre sıfırlama bağlantısı oluşturuldu.');
            $this->redirect(url('/forgot-password'));
        }

        $token = bin2hex(random_bytes(32));
        Database::execute(
            "INSERT INTO password_resets (email, token, created_at, expires_at) 
             VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 1 HOUR))",
            [$email, $token]
        );

        $resetUrl = url('/reset-password/' . $token);
        Session::setFlash('forgot_success', 'Şifre sıfırlama bağlantısı başarıyla oluşturuldu. Aşağıdaki bağlantıdan yeni şifrenizi belirleyebilirsiniz.');
        Session::setFlash('reset_link_preview', $resetUrl);

        $this->redirect(url('/forgot-password'));
    }

    public function resetPassword(string $token): void
    {
        $token = trim($token);
        $reset = Database::fetch(
            "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW() ORDER BY id DESC LIMIT 1",
            [$token]
        );

        if (!$reset) {
            Session::setFlash('forgot_error', 'Şifre sıfırlama bağlantınızın süresi dolmuş veya geçersiz. Lütfen tekrar talep ediniz.');
            $this->redirect(url('/forgot-password'));
        }

        $error = Session::getFlash('reset_error');
        $this->render('pages/auth/reset_password', [
            'metaTitle' => 'Yeni Şifre Belirle | Fizyobar',
            'token' => $token,
            'email' => $reset['email'],
            'error' => $error
        ]);
    }

    public function resetPasswordProcess(): void
    {
        $token = trim((string)$this->input('token'));
        $password = (string)$this->input('password');
        $passwordConfirm = (string)$this->input('password_confirm');

        if (empty($token) || empty($password)) {
            Session::setFlash('reset_error', 'Lütfen yeni şifrenizi giriniz.');
            $this->redirect(url('/reset-password/' . $token));
        }

        if (strlen($password) < 6) {
            Session::setFlash('reset_error', 'Şifreniz en az 6 karakter olmalıdır.');
            $this->redirect(url('/reset-password/' . $token));
        }

        if ($password !== $passwordConfirm) {
            Session::setFlash('reset_error', 'Şifreler birbiriyle uyuşmuyor.');
            $this->redirect(url('/reset-password/' . $token));
        }

        $reset = Database::fetch(
            "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW() ORDER BY id DESC LIMIT 1",
            [$token]
        );

        if (!$reset) {
            Session::setFlash('forgot_error', 'Geçersiz veya süresi dolmuş sıfırlama talebi.');
            $this->redirect(url('/forgot-password'));
        }

        $newHash = password_hash($password, PASSWORD_BCRYPT);
        Database::execute(
            "UPDATE users SET password_hash = ?, updated_at = NOW() WHERE email = ?",
            [$newHash, $reset['email']]
        );

        // Kullanılan tokenları temizle
        Database::execute("DELETE FROM password_resets WHERE email = ?", [$reset['email']]);

        Session::setFlash('login_error', 'Şifreniz başarıyla güncellendi! Yeni şifrenizle giriş yapabilirsiniz.');
        $this->redirect(url('/login'));
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect(url('/login'));
    }
}

