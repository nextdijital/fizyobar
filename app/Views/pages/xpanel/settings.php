<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<!-- Üst Başlık & Açıklama Barı -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.35rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.25rem 0; letter-spacing: -0.02em;">
            ⚙️ Site, Marka ve Ödeme Yapılandırması
        </h1>
        <p style="color: #64748b; font-size: 0.84rem; margin: 0;">
            Burada yapılan tüm değişiklikler web sitesinin header, footer, iletişim ve ödeme alanlarına anında yansır.
        </p>
    </div>
</div>

<form action="<?= url('/xpanel/settings/save') ?>" method="POST" autocomplete="off">
    <?= csrf_field() ?>

    <div style="display: grid; grid-template-columns: 1.15fr 1fr; gap: 1.5rem; align-items: start;">
        
        <!-- =========================================================================
             SOL KOLON: GENEL MARKA & İLETİŞİM BİLGİLERİ
             ========================================================================= -->
        <div class="xp-table-card" style="padding: 1.5rem; margin-bottom: 0;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--xp-border); margin-bottom: 1.25rem;">
                <div>
                    <h2 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                        🏢 1. Genel Marka, Site &amp; İletişim Bilgileri
                    </h2>
                    <span style="font-size: 0.78rem; color: #64748b;">Logolar, unvanlar, duyurular ve iletişim kanalları</span>
                </div>
                <span class="xp-status-dot-pill xp-status-dot-pill-green">● Genel Ayarlar</span>
            </div>

            <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="brand_name">Marka Adı *</label>
                    <input type="text" id="brand_name" name="brand_name" class="xp-form-input" value="<?= e($settings['brand_name'] ?? 'FİZYOBAR') ?>" required placeholder="FİZYOBAR">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label" for="founder_name">Kurucu &amp; Unvan *</label>
                    <input type="text" id="founder_name" name="founder_name" class="xp-form-input" value="<?= e($settings['founder_name'] ?? 'Betina Tansuğ (Fizyoterapist & Yoga Eğitmeni)') ?>" required>
                </div>
            </div>

            <div class="xp-form-group" style="margin-bottom: 1rem;">
                <label class="xp-form-label" for="site_title">Site Başlığı (SEO Title &amp; Meta) *</label>
                <input type="text" id="site_title" name="site_title" class="xp-form-input" value="<?= e($settings['site_title'] ?? 'Fizyobar | Modern Hareket & Longevity Portalı') ?>" required>
            </div>

            <div class="xp-form-group" style="margin-bottom: 1rem;">
                <label class="xp-form-label" for="announcement_text">Üst Kırmızı Duyuru Bandı Metni</label>
                <input type="text" id="announcement_text" name="announcement_text" class="xp-form-input" value="<?= e($settings['announcement_text'] ?? '') ?>" placeholder="Örn: 4 Haftalık Online Detox & Yoga Kampı Başlıyor!">
            </div>

            <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="phone">Telefon Numarası</label>
                    <input type="text" id="phone" name="phone" class="xp-form-input" value="<?= e($settings['phone'] ?? '0535 705 68 28') ?>" placeholder="0535 705 68 28">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label" for="whatsapp">WhatsApp Hızlı İletişim Linki</label>
                    <input type="text" id="whatsapp" name="whatsapp" class="xp-form-input" value="<?= e($settings['whatsapp'] ?? 'https://wa.me/905357056828') ?>" placeholder="https://wa.me/...">
                </div>
            </div>

            <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="email">Resmi E-Posta Adresi</label>
                    <input type="email" id="email" name="email" class="xp-form-input" value="<?= e($settings['email'] ?? 'betinabaram@gmail.com') ?>" placeholder="ornek@fizyobar.com">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label" for="instagram">Instagram Kullanıcı Adı / Link</label>
                    <input type="text" id="instagram" name="instagram" class="xp-form-input" value="<?= e($settings['instagram'] ?? '@fizyobar') ?>" placeholder="@fizyobar">
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="location">Stüdyo &amp; Klinik Lokasyon Adresi</label>
                <input type="text" id="location" name="location" class="xp-form-input" value="<?= e($settings['location'] ?? 'Yenibaraj Mah. Gülek Plaza, Seyhan / Adana') ?>">
            </div>
        </div>

        <!-- =========================================================================
             SAĞ KOLON: ÖDEME ALTYAPISI (IBAN & İYZİCO)
             ========================================================================= -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <!-- 2. Banka Havale / EFT & IBAN Bilgileri -->
            <div class="xp-table-card" style="padding: 1.5rem; margin-bottom: 0; border-top: 4px solid #10b981;">
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--xp-border); margin-bottom: 1.25rem;">
                    <div>
                        <h2 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                            💳 2. Banka Havale / EFT &amp; IBAN Bilgileri
                        </h2>
                        <span style="font-size: 0.78rem; color: #64748b;">Sitede ödemelerde gösterilen resmi banka hesabı</span>
                    </div>
                    <span class="xp-status-dot-pill xp-status-dot-pill-green">● Aktif Ödeme</span>
                </div>

                <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="iban_bank">Banka Adı *</label>
                        <input type="text" id="iban_bank" name="iban_bank" class="xp-form-input" value="<?= e($settings['iban_bank'] ?? 'Garanti BBVA') ?>" required placeholder="Garanti BBVA">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="iban_name">Hesap Sahibi (Alıcı Adı) *</label>
                        <input type="text" id="iban_name" name="iban_name" class="xp-form-input" value="<?= e($settings['iban_name'] ?? 'Betina Tansuğ') ?>" required placeholder="Ad Soyad">
                    </div>
                </div>

                <div class="xp-form-group" style="margin-bottom: 1rem;">
                    <label class="xp-form-label" for="iban_no">IBAN Numarası *</label>
                    <input type="text" id="iban_no" name="iban_no" class="xp-form-input" style="font-family: monospace; font-size: 0.95rem; font-weight: 700;" value="<?= e($settings['iban_no'] ?? 'TR33 0006 2000 0001 2345 6789 01') ?>" required>
                </div>

                <div class="xp-form-group">
                    <label class="xp-form-label" for="iban_notes">Ödeme Açıklama Talimatı</label>
                    <textarea id="iban_notes" name="iban_notes" class="xp-form-textarea" rows="2" placeholder="Ödeme açıklama alanına Ad Soyad ve Referans Kodunuzu mutlaka yazınız..."><?= e($settings['iban_notes'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- 3. İyzico Kredi Kartı Altyapısı -->
            <div class="xp-table-card" style="padding: 1.5rem; margin-bottom: 0; border-top: 4px solid #6366f1;">
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--xp-border); margin-bottom: 1.25rem;">
                    <div>
                        <h2 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                            🔒 3. İyzico Kredi Kartı Altyapısı
                        </h2>
                        <span style="font-size: 0.78rem; color: #64748b;">Online kredi kartı tahsilat modülü</span>
                    </div>
                    <div>
                        <select name="iyzico_status" class="xp-form-select" style="padding: 4px 10px; font-size: 0.76rem; font-weight: 700; border-radius: var(--xp-radius-pill);">
                            <option value="0" <?= ($settings['iyzico_status'] ?? '0') === '0' ? 'selected' : '' ?>>● Pasif (Sadece Havale/IBAN)</option>
                            <option value="1" <?= ($settings['iyzico_status'] ?? '0') === '1' ? 'selected' : '' ?>>● Aktif (Kredi Kartı + IBAN)</option>
                        </select>
                    </div>
                </div>

                <div style="background: #f8fafc; border: 1px solid var(--xp-border); border-radius: var(--xp-radius-sm); padding: 0.75rem 1rem; font-size: 0.78rem; color: #64748b; margin-bottom: 1rem; line-height: 1.45;">
                    ℹ İleride İyzico ile doğrudan kredi kartı tahsilatı açmak istediğinizde API bilgilerinizi girip durumu 'Aktif' yapmanız yeterlidir. Altyapı tüm modülleriyle hazır kuruludur.
                </div>

                <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="iyzico_api_key">İyzico API Key</label>
                        <input type="text" id="iyzico_api_key" name="iyzico_api_key" class="xp-form-input" value="<?= e($settings['iyzico_api_key'] ?? '') ?>" placeholder="sandbox-...">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="iyzico_secret_key">İyzico Secret Key</label>
                        <input type="password" id="iyzico_secret_key" name="iyzico_secret_key" class="xp-form-input" value="<?= e($settings['iyzico_secret_key'] ?? '') ?>" placeholder="••••••••">
                    </div>
                </div>

                <div class="xp-form-group">
                    <label class="xp-form-label" for="iyzico_base_url">API Base URL</label>
                    <input type="text" id="iyzico_base_url" name="iyzico_base_url" class="xp-form-input" value="<?= e($settings['iyzico_base_url'] ?? 'https://sandbox-api.iyzipay.com') ?>">
                </div>
            </div>

            <!-- Kaydet Buton Kartı -->
            <div class="xp-table-card" style="padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center; background: #ffffff; border: 1px solid var(--xp-border);">
                <span style="font-size: 0.82rem; color: #64748b; font-weight: 600;">
                    ✓ Değişiklikler anında canlıya aktarılır
                </span>
                <button type="submit" class="xp-btn-pill-primary" style="padding: 0.65rem 1.85rem; font-size: 0.88rem;">
                    💾 TÜM AYARLARI KAYDET &rarr;
                </button>
            </div>

        </div>

    </div>
</form>

<?php require __DIR__ . '/layout_bottom.php'; ?>
