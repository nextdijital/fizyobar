<?php
declare(strict_types=1);
?>

<div class="auth-page-wrapper">
    <div class="container auth-container">
        <div class="auth-card">
            <!-- Üst Başlık & Kicker (Ortalanmış, Şık Tipografi) -->
            <div class="auth-header">
                <span class="auth-badge-kicker">YENİ ÜYELİK</span>
                <h1 class="auth-main-title">Fizyobar Ailesine Katılın</h1>
                <p class="auth-lead-subtitle">Bilimsel altyapılı bütüncül wellness ve online eğitim platformu.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert-error">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/register/process') ?>" method="POST" class="auth-form">
                <?= csrf_field() ?>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="full_name">ADINIZ SOYADINIZ *</label>
                    <input type="text" id="full_name" name="full_name" class="auth-form-input" required autocomplete="name">
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="email">E-POSTA ADRESİ *</label>
                    <input type="email" id="email" name="email" class="auth-form-input" required autocomplete="email">
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="phone">TELEFON / WHATSAPP *</label>
                    <input type="tel" id="phone" name="phone" class="auth-form-input" required autocomplete="tel">
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="password">ŞİFRE * (En az 6 karakter)</label>
                    <input type="password" id="password" name="password" class="auth-form-input" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn-pill-solid auth-submit-btn">
                    HESAP OLUŞTUR &rarr;
                </button>

                <div class="auth-footer-nav">
                    <span>Zaten hesabınız var mı?</span>
                    <a href="<?= url('/login') ?>" class="auth-link-bold">Giriş Yapın</a>
                </div>
            </form>
        </div>
    </div>
</div>

