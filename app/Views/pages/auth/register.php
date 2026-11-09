<?php
declare(strict_types=1);
?>

<div class="split-auth-page">
    <div class="split-auth-container">
        <!-- SOL PANEL: Görsel & Beyaza Kaçan Hafif Dumanlı Geçiş -->
        <div class="split-auth-visual">
            <div class="auth-visual-overlay"></div>
            <img src="<?= asset('assets/images/betina-outdoor-stretch.jpg') ?>" 
                 alt="Fizyobar Üyelik" 
                 class="auth-visual-image">
            <div class="auth-visual-caption">
                <span class="visual-brand-tag">FİZYOBAR &bull; BODY • ADAPT • REFRAME</span>
                <h2 class="visual-brand-motto">Bedeninle Yeniden Bağ Kur. Kanıta Dayalı Bütüncül Wellness.</h2>
            </div>
        </div>

        <!-- SAĞ PANEL: Koyu Minimalist Form Alanı -->
        <div class="split-auth-form-wrap">
            <div class="split-auth-form-box">
                <!-- Başlık & Açıklama -->
                <div class="split-auth-header">
                    <h1 class="split-auth-title">Hesap Oluştur</h1>
                    <p class="split-auth-subtitle">Fizyobar ailesine katılın, seans ve içeriklerinize anında erişin.</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="split-auth-alert">
                        <?= e($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= url('/register/process') ?>" method="POST" class="split-auth-form">
                    <?= csrf_field() ?>

                    <!-- Ad Soyad Input -->
                    <div class="split-form-group">
                        <label class="split-form-label" for="full_name">Adınız Soyadınız</label>
                        <input type="text" 
                               id="full_name" 
                               name="full_name" 
                               class="split-pill-input" 
                               placeholder="Adınızı ve soyadınızı girin" 
                               required 
                               autocomplete="name">
                    </div>

                    <!-- Email Input -->
                    <div class="split-form-group">
                        <label class="split-form-label" for="email">E-posta</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="split-pill-input" 
                               placeholder="E-posta adresinizi girin" 
                               required 
                               autocomplete="email">
                    </div>

                    <!-- Telefon Input -->
                    <div class="split-form-group">
                        <label class="split-form-label" for="phone">Telefon / WhatsApp</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="split-pill-input" 
                               placeholder="05XX XXX XX XX" 
                               required 
                               autocomplete="tel">
                    </div>

                    <!-- Şifre Input -->
                    <div class="split-form-group">
                        <label class="split-form-label" for="password">Şifre (En az 6 karakter)</label>
                        <div class="split-input-wrapper">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="split-pill-input split-input-password" 
                                   placeholder="Güçlü bir şifre belirleyin" 
                                   required 
                                   autocomplete="new-password">
                            <button type="button" class="split-pwd-toggle" id="pwdToggleBtn" aria-label="Şifreyi Göster/Gizle" title="Şifreyi Göster">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Hesap Oluştur Butonu -->
                    <button type="submit" class="split-submit-btn">
                        Hesap Oluştur
                    </button>

                    <!-- Alt Giriş Yap Linki -->
                    <div class="split-footer-link">
                        <span>Zaten hesabınız var mı?</span>
                        <a href="<?= url('/login') ?>" class="split-register-link">Giriş Yapın</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pwdInput = document.getElementById('password');
    const toggleBtn = document.getElementById('pwdToggleBtn');
    if (!pwdInput || !toggleBtn) return;

    toggleBtn.addEventListener('click', function() {
        const isPassword = pwdInput.getAttribute('type') === 'password';
        pwdInput.setAttribute('type', isPassword ? 'text' : 'password');
        this.innerHTML = isPassword 
            ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>'
            : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
    });
});
</script>

