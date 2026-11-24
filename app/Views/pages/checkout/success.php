<?php
declare(strict_types=1);
/**
 * @var array $enrollment
 * @var string $ibanBank
 * @var string $ibanName
 * @var string $ibanNo
 */
?>

<style>
.checkout-success-wrapper {
    background: #353334 !important;
    background-color: #353334 !important;
    min-height: 100vh;
    color: #ffffff !important;
    padding: clamp(3rem, 5vw, 4.5rem) 0 5rem;
    font-family: var(--font-sans, sans-serif);
}
.checkout-success-container {
    max-width: 680px !important;
    margin: 0 auto !important;
    text-align: center !important;
    padding: 0 1.25rem;
}
.success-card {
    background: #272526 !important;
    border: 1.5px solid rgba(34, 197, 94, 0.35) !important;
    border-radius: 26px !important;
    padding: clamp(2.5rem, 5vw, 4rem) !important;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4) !important;
}
.success-icon-badge {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(34, 197, 94, 0.15);
    border: 2px solid #22c55e;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}
.success-kicker {
    display: block;
    font-size: 0.76rem;
    font-weight: 800;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #22c55e;
    margin-bottom: 0.5rem;
}
.success-title {
    font-size: clamp(2rem, 3.5vw, 2.7rem);
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 0.6rem;
}
.success-subtitle {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.82);
    line-height: 1.6;
    margin: 0 0 2rem;
}
.success-meta-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    background: #1c1a1b;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 14px;
    padding: 1.25rem;
    margin-bottom: 1.8rem;
    text-align: left;
}
.meta-item {
    display: flex;
    flex-direction: column;
}
.meta-lbl {
    font-size: 0.74rem;
    color: rgba(255, 255, 255, 0.6);
}
.meta-val {
    font-size: 1.05rem;
    font-weight: 800;
    color: #ffffff;
    margin-top: 2px;
}
.text-green {
    color: #22c55e !important;
}
.success-bank-reminder {
    background: rgba(74, 20, 33, 0.4);
    border: 1px dashed rgba(255, 255, 255, 0.25);
    border-radius: 14px;
    padding: 1.2rem;
    margin-bottom: 2rem;
    text-align: left;
}
.reminder-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
    font-size: 0.86rem;
    color: #ffffff;
    margin-bottom: 6px;
}
.reminder-body {
    font-size: 0.9rem;
    color: #ffffff;
    margin: 0 0 6px;
    line-height: 1.5;
}
.reminder-body code {
    font-family: monospace;
    font-size: 0.9rem;
    color: #22c55e;
}
.reminder-note {
    font-size: 0.76rem;
    color: rgba(255, 255, 255, 0.75);
    display: block;
}
.success-actions-row {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: stretch;
}
.btn-success-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #4a1421;
    color: #ffffff !important;
    border: 1.5px solid #4a1421;
    border-radius: 999px;
    font-size: 0.96rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 1.15rem 2rem;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(74, 20, 33, 0.5);
    transition: all 0.2s ease;
}
.btn-success-primary:hover {
    background: #350d17;
    border-color: #350d17;
    transform: translateY(-1px);
}
.btn-success-whatsapp {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #22c55e;
    color: #ffffff !important;
    border: 1.5px solid #22c55e;
    border-radius: 999px;
    font-size: 0.92rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    padding: 0.95rem 2rem;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(34, 197, 94, 0.35);
    transition: all 0.2s ease;
}
.btn-success-whatsapp:hover {
    background: #16a34a;
    border-color: #16a34a;
    transform: translateY(-1px);
}
@media (max-width: 600px) {
    .success-meta-box {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- ==============================================================================
     FİZYOBAR: BAŞARILI KAYIT & HAVALE ONAYI (LÜKS EDİTORYAL GRİ SAYFA)
     ============================================================================== -->
<div class="checkout-success-wrapper">
    <div class="container checkout-success-container">

        <div class="success-card">
            
            <div class="success-icon-badge">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>

            <span class="success-kicker">KAYIT VE HAVALE BİLDİRİMİNİZ ALINDI</span>
            <h1 class="success-title">Movement Space Alanınız Hazır!</h1>
            <p class="success-subtitle">
                <strong><?= e($enrollment['course_title']) ?></strong> programına kaydınız başarıyla tamamlandı ve eğitim paneliniz erişime açıldı.
            </p>

            <div class="success-meta-box">
                <div class="meta-item">
                    <span class="meta-lbl">Kayıt Referans No:</span>
                    <strong class="meta-val">#<?= (int)$enrollment['id'] ?></strong>
                </div>
                <div class="meta-item">
                    <span class="meta-lbl">Program Tutarı:</span>
                    <strong class="meta-val text-green">₺<?= number_format((float)$enrollment['amount'], 2, ',', '.') ?></strong>
                </div>
                <div class="meta-item">
                    <span class="meta-lbl">Havale Yapan:</span>
                    <strong class="meta-val"><?= e($enrollment['sender_name'] ?: 'Öğrenci') ?></strong>
                </div>
                <div class="meta-item">
                    <span class="meta-lbl">Erişim Süresi:</span>
                    <strong class="meta-val">90 Gün / Sınırsız Arşiv</strong>
                </div>
            </div>

            <!-- Havale Hatırlatması -->
            <div class="success-bank-reminder">
                <div class="reminder-header">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span>Havale / EFT İşlemini Henüz Tamamlamadıysanız:</span>
                </div>
                <p class="reminder-body">
                    <strong><?= e($ibanBank) ?></strong> &bull; <?= e($ibanName) ?><br>
                    <code><?= e($ibanNo) ?></code>
                </p>
                <small class="reminder-note">Lütfen banka transferi açıklama alanına <strong>#<?= (int)$enrollment['id'] ?></strong> referans numaranızı veya Adınızı belirtiniz.</small>
            </div>

            <!-- Aksiyon Butonları -->
            <div class="success-actions-row">
                <a href="<?= url('/movement-space') ?>" class="btn-success-primary">
                    <span>HAREKET ALANIMA BAŞLA (EĞİTİM PANELİ) &rarr;</span>
                </a>
                <a href="https://wa.me/905357056828?text=Merhaba%20Betina%20Hocam,%20%23<?= (int)$enrollment['id'] ?>%20referans%20numaras%C4%B1%20ile%20Online%20Detox%20ve%20Yoga%20Kamp%C4%B1%20kayd%C4%B1m%C4%B1%20tamamlad%C4%B1m." 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="btn-success-whatsapp">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    <span>WhatsApp Eğitmen Grubuna Katıl</span>
                </a>
            </div>

        </div>

    </div>
</div>
