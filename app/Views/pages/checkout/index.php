<?php
declare(strict_types=1);
/**
 * @var array $course
 * @var array|null $user
 * @var bool $isLoggedIn
 * @var string $planType
 * @var float $activePrice
 * @var string|null $errorMsg
 * @var string|null $infoMsg
 * @var string $ibanBank
 * @var string $ibanName
 * @var string $ibanNo
 * @var string $ibanNotes
 */
?>

<style>
/* ==============================================================================
   CHECKOUT SAYFASI ÖZEL & KORUMALI STİLLERİ (ÖNBELLEK VE İZOLASYON GARANTİLİ)
   ============================================================================== */
.checkout-fast-page {
    background: #353334 !important;
    background-color: #353334 !important;
    min-height: 100vh;
    color: #ffffff !important;
    padding: clamp(3rem, 5vw, 4.5rem) 0 5rem;
    font-family: var(--font-sans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif);
}

.checkout-fast-container {
    max-width: 980px;
    margin: 0 auto;
    padding: 0 1.25rem;
}

.checkout-fast-head {
    margin-bottom: 2.5rem;
    text-align: center;
}

.fast-kicker {
    display: block;
    font-size: 0.74rem;
    font-weight: 800;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #ffffff;
    opacity: 0.85;
    margin-bottom: 0.4rem;
}

.fast-title {
    font-size: clamp(1.8rem, 3.2vw, 2.6rem);
    font-weight: 900;
    text-transform: uppercase;
    color: #ffffff !important;
    letter-spacing: -0.01em;
    margin: 0 0 0.5rem;
    line-height: 1.15;
}

.fast-subtitle {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.76);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.55;
}

.fast-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    border-radius: 12px;
    padding: 12px 18px;
    margin-bottom: 2rem;
    font-size: 0.9rem;
}

.fast-alert.alert-error {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.4);
    color: #fca5a5;
}

.fast-alert.alert-info {
    background: rgba(59, 130, 246, 0.15);
    border: 1px solid rgba(59, 130, 246, 0.4);
    color: #93c5fd;
}

.fast-checkout-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 1.8rem !important;
    align-items: flex-start !important;
    margin-bottom: 2.2rem !important;
}

.fast-card {
    background: #272526 !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 18px !important;
    padding: clamp(1.5rem, 2.5vw, 2.2rem) !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25) !important;
}

.fast-card-header {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    margin-bottom: 1.25rem !important;
    padding-bottom: 0.85rem !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
}

.fast-step-badge {
    font-size: 0.7rem !important;
    font-weight: 800 !important;
    letter-spacing: 0.12em !important;
    background: #4a1421 !important;
    color: #ffffff !important;
    padding: 4px 10px !important;
    border-radius: 999px !important;
    text-transform: uppercase !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

.fast-card-title {
    font-size: 1.15rem !important;
    font-weight: 900 !important;
    color: #ffffff !important;
    margin: 0 !important;
}

.fast-logged-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: rgba(34, 197, 94, 0.08);
    border: 1px solid rgba(34, 197, 94, 0.25);
    border-radius: 14px;
    padding: 1.1rem;
}

.fast-dot-online {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 10px #22c55e;
    margin-top: 5px;
    flex-shrink: 0;
}

.fast-user-name {
    display: block;
    font-size: 1rem;
    font-weight: 800;
    color: #ffffff;
}

.fast-user-email {
    display: block;
    font-size: 0.82rem;
    color: #22c55e;
    margin: 2px 0 4px;
    font-weight: 600;
}

.fast-user-status {
    font-size: 0.76rem;
    color: rgba(255, 255, 255, 0.65);
    margin: 0;
}

.fast-form-group {
    margin-bottom: 1.15rem !important;
    display: flex !important;
    flex-direction: column !important;
}

.fast-form-row {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 1rem !important;
    margin-bottom: 0 !important;
}

.fast-label {
    display: block !important;
    font-size: 0.82rem !important;
    font-weight: 700 !important;
    color: rgba(255, 255, 255, 0.9) !important;
    margin-bottom: 6px !important;
    letter-spacing: 0.03em !important;
}

.fast-input {
    display: block !important;
    width: 100% !important;
    box-sizing: border-box !important;
    background: #1c1a1b !important;
    border: 1.5px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 10px !important;
    padding: 12px 14px !important;
    font-size: 0.92rem !important;
    color: #ffffff !important;
    transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    outline: none !important;
}

.fast-input:focus {
    border-color: #ffffff !important;
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.15) !important;
}

.fast-hint {
    display: block !important;
    font-size: 0.72rem !important;
    color: rgba(255, 255, 255, 0.55) !important;
    margin-top: 4px !important;
}

.fast-perks {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 0 1.25rem !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 8px !important;
}

.fast-perks li {
    font-size: 0.86rem !important;
    color: rgba(255, 255, 255, 0.84) !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.fast-perks .perk-check {
    color: #22c55e !important;
    font-weight: 800 !important;
}

.fast-price-box {
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding-top: 1rem !important;
    display: flex !important;
    flex-direction: column !important;
}

.price-lbl {
    font-size: 0.85rem !important;
    color: rgba(255, 255, 255, 0.7) !important;
}

.fast-price-box .price-amount {
    font-size: 2rem !important;
    font-weight: 900 !important;
    color: #ffffff !important;
    line-height: 1.1 !important;
    margin: 2px 0 !important;
}

.price-sub {
    font-size: 0.74rem !important;
    color: rgba(255, 255, 255, 0.62) !important;
}

.iban-card {
    border-color: rgba(255, 255, 255, 0.12) !important;
}

.iban-title {
    font-size: 1.1rem !important;
    font-weight: 900 !important;
    color: #ffffff !important;
    margin: 0 0 0.9rem !important;
}

.iban-rows {
    display: flex !important;
    flex-direction: column !important;
    gap: 8px !important;
    margin-bottom: 0.9rem !important;
}

.iban-row {
    display: flex !important;
    align-items: baseline !important;
    justify-content: space-between !important;
    font-size: 0.86rem !important;
}

.iban-row .lbl {
    color: rgba(255, 255, 255, 0.65) !important;
}

.iban-row .val {
    color: #ffffff !important;
    font-weight: 800 !important;
}

.iban-code-container {
    display: flex !important;
    flex-direction: column !important;
    gap: 4px !important;
    margin-top: 4px !important;
}

.iban-copy-box {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 8px !important;
    width: 100% !important;
    box-sizing: border-box !important;
    background: #1c1a1b !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 9px !important;
    padding: 8px 12px !important;
}

.iban-copy-box code {
    font-family: monospace !important;
    font-size: 0.88rem !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    letter-spacing: 0.03em !important;
}

.btn-fast-copy {
    background: #4a1421 !important;
    color: #ffffff !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    border-radius: 6px !important;
    padding: 6px 12px !important;
    font-size: 0.72rem !important;
    font-weight: 800 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    flex-shrink: 0 !important;
}

.btn-fast-copy:hover {
    background: #61182a !important;
}

.iban-note-box {
    display: flex !important;
    align-items: flex-start !important;
    gap: 8px !important;
    background: rgba(74, 20, 33, 0.4) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-radius: 9px !important;
    padding: 9px 12px !important;
    font-size: 0.78rem !important;
    color: rgba(255, 255, 255, 0.85) !important;
    line-height: 1.45 !important;
}

.iban-note-box svg {
    color: #ffffff !important;
    opacity: 0.85 !important;
    flex-shrink: 0 !important;
    margin-top: 2px !important;
}

.fast-submit-wrap {
    max-width: 640px !important;
    margin: 0 auto !important;
    text-align: center !important;
}

.btn-fast-confirm {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    width: 100% !important;
    background: #4a1421 !important;
    color: #ffffff !important;
    border: 1.5px solid #4a1421 !important;
    border-radius: 999px !important;
    font-size: 1.05rem !important;
    font-weight: 900 !important;
    letter-spacing: 0.08em !important;
    text-transform: uppercase !important;
    padding: 1.2rem 2.5rem !important;
    cursor: pointer !important;
    box-shadow: 0 10px 25px rgba(74, 20, 33, 0.45) !important;
    transition: all 0.2s ease !important;
}

.btn-fast-confirm:hover {
    background: #350d17 !important;
    border-color: #350d17 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 35px rgba(74, 20, 33, 0.6) !important;
}

.fast-security-badges {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    flex-wrap: wrap !important;
    margin-top: 1rem !important;
    font-size: 0.78rem !important;
    color: rgba(255, 255, 255, 0.65) !important;
}

@media (max-width: 768px) {
    .fast-checkout-grid {
        grid-template-columns: 1fr !important;
    }
    .fast-form-row {
        grid-template-columns: 1fr !important;
    }
}
</style>

<!-- ==============================================================================
     FİZYOBAR: HIZLI & GÜVENLİ KAYIT VE HAVALE ÖDEME SAYFASI (SADE VE DÜZGÜN)
     ============================================================================== -->
<div class="checkout-fast-page">
    <div class="container checkout-fast-container">

        <!-- Sayfa Başlığı -->
        <div class="checkout-fast-head text-center">
            <span class="fast-kicker">GÜVENLİ KAYIT &bull; FİZYOBAR ONLINE DÖNÜŞÜM KAMPI</span>
            <h1 class="fast-title"><?= e($course['title']) ?></h1>
            <p class="fast-subtitle">Bilgilerinizi girip havale bildiriminizi yaparak eğitim panelinize ve canlı derslerinize anında başlayabilirsiniz.</p>
        </div>

        <?php if (!empty($errorMsg)): ?>
            <div class="fast-alert alert-error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span><?= e($errorMsg) ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($infoMsg)): ?>
            <div class="fast-alert alert-info">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                <span><?= e($infoMsg) ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= url('/checkout/' . (int)$course['id'] . '/submit-iban') ?>" method="POST" id="fastCheckoutForm">
            <?= csrf_field() ?>
            <input type="hidden" name="plan_type" value="<?= e($planType) ?>">
            <input type="hidden" name="amount" value="<?= (float)$activePrice ?>">

            <div class="fast-checkout-grid">
                
                <!-- SOL KOLON: ÖĞRENCİ BİLGİLERİ (HIZLI & KOLAY KAYIT) -->
                <div class="fast-col-form">
                    <div class="fast-card">
                        <div class="fast-card-header">
                            <span class="fast-step-badge">1. ADIM</span>
                            <h2 class="fast-card-title">Öğrenci Bilgileri</h2>
                        </div>

                        <?php if ($isLoggedIn): ?>
                            <!-- Giriş Yapmış Öğrenci -->
                            <div class="fast-logged-box">
                                <div class="fast-dot-online"></div>
                                <div>
                                    <strong class="fast-user-name"><?= e($user['full_name']) ?></strong>
                                    <span class="fast-user-email"><?= e($user['email']) ?></span>
                                    <small class="fast-user-status">Giriş yapıldı &bull; Eğitim doğrudan bu hesabınıza tanımlanacaktır.</small>
                                </div>
                            </div>

                            <div class="fast-form-group" style="margin-top: 1.25rem;">
                                <label class="fast-label" for="sender_name">Havale Yapan Ad Soyad *</label>
                                <input type="text" id="sender_name" name="sender_name" class="fast-input" required 
                                       value="<?= e($user['full_name']) ?>" 
                                       placeholder="Banka hesabında görünen isim">
                            </div>
                        <?php else: ?>
                            <!-- Hızlı Kayıt Formu (3-4 Temiz Alan) -->
                            <div class="fast-form-group">
                                <label class="fast-label" for="full_name">Adınız ve Soyadınız *</label>
                                <input type="text" id="full_name" name="full_name" class="fast-input" required 
                                       placeholder="Örn: Ayşe Yılmaz" autocomplete="name">
                            </div>

                            <div class="fast-form-row">
                                <div class="fast-form-group">
                                    <label class="fast-label" for="phone">WhatsApp Telefon Numaranız *</label>
                                    <input type="tel" id="phone" name="phone" class="fast-input" required 
                                           placeholder="0532 123 45 67" autocomplete="tel">
                                    <small class="fast-hint">Canlı ders bildirimleri ve eğitmen takibi için.</small>
                                </div>
                                <div class="fast-form-group">
                                    <label class="fast-label" for="email">E-posta Adresiniz *</label>
                                    <input type="email" id="email" name="email" class="fast-input" required 
                                           placeholder="ornek@email.com" autocomplete="email">
                                    <small class="fast-hint">Panel kullanıcı adınız olacaktır.</small>
                                </div>
                            </div>

                            <div class="fast-form-group">
                                <label class="fast-label" for="password">Öğrenci Paneli Giriş Şifreniz *</label>
                                <input type="password" id="password" name="password" class="fast-input" required 
                                       placeholder="En az 6 karakter" autocomplete="new-password">
                                <small class="fast-hint">Kayıt sonrası eğitim videolarınıza bu şifre ile erişeceksiniz.</small>
                            </div>

                            <div class="fast-form-group">
                                <label class="fast-label" for="sender_name">Havale Gönderen Kişinin Adı Soyadı</label>
                                <input type="text" id="sender_name" name="sender_name" class="fast-input" 
                                       placeholder="Farklı bir hesaptan gönderiliyorsa yazınız">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- SAĞ KOLON: PROGRAM ÖZETİ & BANKA HESAP BİLGİLERİ -->
                <div class="fast-col-summary">
                    
                    <!-- Program Özeti -->
                    <div class="fast-card">
                        <div class="fast-card-header">
                            <span class="fast-step-badge badge-burgundy">SEÇİLEN PROGRAM</span>
                            <h2 class="fast-card-title"><?= e($course['title']) ?></h2>
                        </div>

                        <ul class="fast-perks">
                            <li><span class="perk-check">✓</span> 16+ Canlı Seans &amp; 7/24 HD Kayıt Arşivi</li>
                            <li><span class="perk-check">✓</span> 28 Günlük Adım Adım Faz Haritası</li>
                            <li><span class="perk-check">✓</span> Rafinesiz Glisemik Menü Kitapçığı</li>
                            <li><span class="perk-check">✓</span> Betina Tansuğ ile Birebir WhatsApp Takibi</li>
                            <li><span class="perk-check">★</span> <strong>Hediye:</strong> 3'lü Ses Çanağı Meditasyon Paketi</li>
                        </ul>

                        <div class="fast-price-box">
                            <span class="price-lbl">Toplam Yatırım:</span>
                            <strong class="price-amount">₺<?= number_format((float)$activePrice, 2, ',', '.') ?></strong>
                            <small class="price-sub">Tek seferlik ödeme &bull; Tüm 4 haftalık program dahil</small>
                        </div>
                    </div>

                    <!-- Banka Bilgisi (IBAN Kartı) -->
                    <div class="fast-card iban-card" style="margin-top: 1.25rem;">
                        <h3 class="iban-title">Havale / EFT Bilgileri</h3>

                        <div class="iban-rows">
                            <div class="iban-row">
                                <span class="lbl">Banka:</span>
                                <strong class="val"><?= e($ibanBank) ?></strong>
                            </div>
                            <div class="iban-row">
                                <span class="lbl">Hesap Sahibi:</span>
                                <strong class="val"><?= e($ibanName) ?></strong>
                            </div>
                            <div class="iban-code-container">
                                <span class="lbl">IBAN Numarası:</span>
                                <div class="iban-copy-box">
                                    <code id="fastIbanCode"><?= e($ibanNo) ?></code>
                                    <button type="button" class="btn-fast-copy" id="fastCopyBtn" onclick="copyFastIban()">
                                        KOPYALA
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="iban-note-box">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span><?= e($ibanNotes) ?></span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- BÜYÜK VE NET KAYIT ONAY BUTONU -->
            <div class="fast-submit-wrap text-center">
                <button type="submit" class="btn-fast-confirm" id="fastSubmitBtn">
                    <span>KAYDI TAMAMLA VE PANELİ AÇ &bull; ₺<?= number_format((float)$activePrice, 2, ',', '.') ?></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>

                <div class="fast-security-badges">
                    <span>🔒 256-Bit SSL Güvenli Bağlantı</span>
                    <span>&bull;</span>
                    <span>⚡ Eğitime ve Panele Anında Erişim</span>
                    <span>&bull;</span>
                    <span>👥 Kontenjan Korumalı (15 Kişi)</span>
                </div>
            </div>

        </form>

    </div>
</div>

<script>
function copyFastIban() {
    var ibanText = document.getElementById('fastIbanCode').innerText.replace(/\s+/g, '');
    navigator.clipboard.writeText(ibanText).then(function() {
        var btn = document.getElementById('fastCopyBtn');
        btn.innerText = 'KOPYALANDI!';
        btn.style.backgroundColor = '#22c55e';
        btn.style.color = '#ffffff';
        setTimeout(function() {
            btn.innerText = 'KOPYALA';
            btn.style.backgroundColor = '';
            btn.style.color = '';
        }, 2500);
    }).catch(function() {
        alert('IBAN kopyalandı: ' + ibanText);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var fullNameInput = document.getElementById('full_name');
    var senderNameInput = document.getElementById('sender_name');

    if (fullNameInput && senderNameInput) {
        fullNameInput.addEventListener('input', function() {
            if (!senderNameInput.dataset.manual) {
                senderNameInput.value = fullNameInput.value;
            }
        });
        senderNameInput.addEventListener('input', function() {
            senderNameInput.dataset.manual = 'true';
        });
    }
});
</script>
