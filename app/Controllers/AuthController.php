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

        Auth::login((int)$user['id']);

        if ($user['role'] === 'admin') {
            $this->redirect(url('/xpanel'));
        }

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
        Auth::login($userId);

        $this->redirect(url('/dashboard'));
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect(url('/login'));
    }
}

