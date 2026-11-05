<?php
declare(strict_types=1);
?>

<div class="page-hero">
    <div class="container">
        <span class="badge-pill section-badge">YENİ ÜYELİK</span>
        <h1 class="section-title" style="font-size: var(--font-h1);">Fizyobar Ailesine Katılın</h1>
        <p class="section-subtitle">Bilimsel altyapılı bütüncül wellness ve online eğitim platformu.</p>
    </div>
</div>

<section style="padding: var(--space-xl) 0;">
    <div class="container" style="max-width: 540px;">
        <div class="form-luxury">
            <?php if (!empty($error)): ?>
                <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.85rem 1rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem; font-size: var(--font-sm);">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/register/process') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label" for="full_name">Adınız Soyadınız *</label>
                    <input type="text" id="full_name" name="full_name" class="form-input" required placeholder="Örn: Selin Yılmaz">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">E-Posta Adresi *</label>
                    <input type="email" id="email" name="email" class="form-input" required placeholder="selin@ornek.com">
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Telefon / WhatsApp *</label>
                    <input type="tel" id="phone" name="phone" class="form-input" required placeholder="0532 123 45 67">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Şifre * (En az 6 karakter)</label>
                    <input type="password" id="password" name="password" class="form-input" required placeholder="••••••••">
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        HESAP OLUŞTUR &rarr;
                    </button>
                </div>

                <div style="text-align: center; margin-top: 1.25rem; font-size: var(--font-sm); color: var(--text-muted);">
                    Zaten hesabınız var mı? <a href="<?= url('/login') ?>" style="color: var(--primary); text-decoration: underline;">Giriş Yapın</a>
                </div>
            </form>
        </div>
    </div>
</section>

