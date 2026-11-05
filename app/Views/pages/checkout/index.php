<?php
declare(strict_types=1);
?>

<div class="page-hero">
    <div class="container">
        <span class="badge-pill section-badge">PROGRAM KAYDI VE ÖDEME</span>
        <h1 class="section-title" style="font-size: var(--font-h1);"><?= e($course['title']) ?></h1>
        <p class="section-subtitle">Aboneliğinizi başlatarak video eğitimlere ve canlı takibe hemen erişin.</p>
    </div>
</div>

<section style="padding: var(--space-xl) 0;">
    <div class="container" style="max-width: 840px;">
        
        <?php if (!empty($infoMsg)): ?>
            <div style="background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e; padding: 0.85rem 1rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem; font-size: var(--font-sm);">
                <?= e($infoMsg) ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-md);" class="checkout-grid">
            
            <!-- Sol: Program Özeti -->
            <div style="background-color: var(--black-card); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: var(--radius-sm); padding: clamp(1.5rem, 3vw, 2.2rem);">
                <span class="badge-pill" style="font-size: 0.65rem; margin-bottom: 0.75rem;">SEÇİLEN PROGRAM</span>
                <h2 style="font-family: var(--font-display); font-size: 1.45rem; font-weight: 800; color: var(--white); margin-bottom: 0.5rem; line-height: 1.25;">
                    <?= e($course['title']) ?>
                </h2>
                <p style="font-size: var(--font-sm); color: var(--text-muted); font-weight: 300; line-height: 1.6; margin-bottom: 1.5rem;">
                    <?= e($course['subtitle']) ?>
                </p>

                <div style="border-top: 1px solid rgba(255, 255, 255, 0.08); border-bottom: 1px solid rgba(255, 255, 255, 0.08); padding: 1rem 0; margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; font-size: var(--font-sm); margin-bottom: 0.4rem;">
                        <span style="color: var(--text-muted);">Program Süresi:</span>
                        <strong style="color: var(--white);"><?= (int)$course['duration_weeks'] ?> Hafta</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: var(--font-sm); margin-bottom: 0.4rem;">
                        <span style="color: var(--text-muted);">Eğitim Formatı:</span>
                        <span style="color: var(--white);">Canlı & Kayıt Seanslar</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 1.3rem; margin-top: 0.75rem; color: #fca5a5;">
                        <span>Toplam Tutar:</span>
                        <strong>₺<?= number_format((float)$course['price'], 2, ',', '.') ?></strong>
                    </div>
                </div>

                <div style="font-size: var(--font-xs); color: var(--text-light); line-height: 1.5;">
                    🛡️ Bilimsel fizyoterapist takibi ve güvenli abonelik onay süreci.
                </div>
            </div>

            <!-- Sağ: IBAN Havale / EFT Ödeme Formu -->
            <div style="background-color: var(--black-card); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: var(--radius-sm); padding: clamp(1.5rem, 3vw, 2.2rem);">
                <h3 style="font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--white); margin-bottom: 1rem;">
                    1. Banka Hesap Bilgileri (IBAN)
                </h3>

                <div style="background-color: #0c0c0c; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius-sm); padding: 1rem; margin-bottom: 1.25rem; font-size: var(--font-sm);">
                    <div style="margin-bottom: 0.35rem;">
                        <span style="color: var(--text-muted);">Banka:</span> <strong style="color: #fff;"><?= e($ibanBank) ?></strong>
                    </div>
                    <div style="margin-bottom: 0.35rem;">
                        <span style="color: var(--text-muted);">Alıcı / Hesap Sahibi:</span> <strong style="color: #fff;"><?= e($ibanName) ?></strong>
                    </div>
                    <div style="margin-bottom: 0.35rem;">
                        <span style="color: var(--text-muted);">IBAN:</span><br>
                        <code style="font-size: 0.95rem; font-weight: 700; color: #fca5a5; display: inline-block; padding: 4px 6px; background: #1c1c1c; border: 1px dashed #fca5a5; margin-top: 4px;"><?= e($ibanNo) ?></code>
                    </div>
                    <p style="font-size: var(--font-xs); color: #fbbf24; margin-top: 0.5rem; line-height: 1.4;">
                        ⚠️ <?= e($ibanNotes) ?>
                    </p>
                </div>

                <h3 style="font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--white); margin-bottom: 0.75rem;">
                    2. Ödeme Bildirimi
                </h3>

                <form action="<?= url('/checkout/' . $course['id'] . '/submit-iban') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label class="form-label" for="sender_name">Havale Yapan Ad Soyad *</label>
                        <input type="text" id="sender_name" name="sender_name" class="form-input" required placeholder="Banka hesabındaki isim">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="receipt_ref">Dekont No / Açıklama Referansı</label>
                        <input type="text" id="receipt_ref" name="receipt_ref" class="form-input" placeholder="Opsiyonel (Dekont referans no)">
                    </div>

                    <div style="margin-top: 1.25rem;">
                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                            HAVALE BİLDİRİMİNİ GÖNDER &rarr;
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>

<style>
@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>

