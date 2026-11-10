<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<div style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <h1 style="font-size: 1.45rem; font-weight: 400; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em;">
                Site, Marka ve Ödeme Yapılandırması
            </h1>
            <p style="color: var(--text-muted); font-size: var(--font-sm);">
                Burada yapılan tüm değişiklikler anında web sitesinin tüm alanlarına yansır.
            </p>
        </div>
    </div>

    <form action="<?= url('/xpanel/settings/save') ?>" method="POST">
        <?= csrf_field() ?>

        <!-- 1. Genel Marka & İletişim Bilgileri -->
        <div class="xpanel-card" style="margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.05rem; font-weight: 500; color: var(--black); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--border-light);">
                1. Genel Marka & İletişim Bilgileri
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Marka Adı</label>
                    <input type="text" name="brand_name" class="form-input" value="<?= e($settings['brand_name'] ?? 'FİZYOBAR') ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kurucu & Unvan</label>
                    <input type="text" name="founder_name" class="form-input" value="<?= e($settings['founder_name'] ?? 'Betina Tansuğ (Fizyoterapist & Yoga Eğitmeni)') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Site Başlığı (Title & Meta)</label>
                <input type="text" name="site_title" class="form-input" value="<?= e($settings['site_title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Üst Duyuru Bandı Metni</label>
                <input type="text" name="announcement_text" class="form-input" value="<?= e($settings['announcement_text'] ?? '') ?>">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Telefon Numarası</label>
                    <input type="text" name="phone" class="form-input" value="<?= e($settings['phone'] ?? '0535 705 68 28') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">WhatsApp Hızlı Linki</label>
                    <input type="text" name="whatsapp" class="form-input" value="<?= e($settings['whatsapp'] ?? 'https://wa.me/905357056828') ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">E-Posta Adresi</label>
                    <input type="email" name="email" class="form-input" value="<?= e($settings['email'] ?? 'betinabaram@gmail.com') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Instagram Kullanıcı Adı</label>
                    <input type="text" name="instagram" class="form-input" value="<?= e($settings['instagram'] ?? '@fizyobar') ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasyon / Stüdyo Adresi</label>
                <input type="text" name="location" class="form-input" value="<?= e($settings['location'] ?? 'Yenibaraj Mah. Gülek Plaza, Seyhan / Adana') ?>">
            </div>
        </div>

        <!-- 2. Banka Havale & IBAN Bilgileri (Abonelik Ödeme Altyapısı) -->
        <div class="xpanel-card" style="margin-bottom: 1.5rem; border-left: 3px solid #10b981;">
            <h3 style="font-size: 1.05rem; font-weight: 500; color: var(--black); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--border-light);">
                2. Banka Havale / EFT & IBAN Bilgileri (Aktif Ödeme Yöntemi)
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Banka Adı</label>
                    <input type="text" name="iban_bank" class="form-input" value="<?= e($settings['iban_bank'] ?? 'Garanti BBVA') ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Hesap Sahibi (Alıcı Adı)</label>
                    <input type="text" name="iban_name" class="form-input" value="<?= e($settings['iban_name'] ?? 'Betina Tansuğ') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">IBAN Numarası</label>
                <input type="text" name="iban_no" class="form-input" value="<?= e($settings['iban_no'] ?? 'TR33 0006 2000 0001 2345 6789 01') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Ödeme Açıklama Talimatı</label>
                <textarea name="iban_notes" class="form-textarea" style="min-height: 80px;"><?= e($settings['iban_notes'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- 3. İyzico Kredi Kartı Altyapısı (Hazır Entegrasyon) -->
        <div class="xpanel-card" style="margin-bottom: 2rem; border-left: 3px solid #6366f1;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="font-size: 1.05rem; font-weight: 500; color: var(--black);">
                    3. İyzico Kredi Kartı Altyapısı (İkinci Faz Entegrasyon)
                </h3>
                <div>
                    <label style="font-size: var(--font-xs); font-weight: 600; text-transform: uppercase;">
                        Durum: 
                        <select name="iyzico_status" style="padding: 3px 8px; border-radius: 4px; border: 1px solid var(--border-color); font-size: var(--font-xs);">
                            <option value="0" <?= ($settings['iyzico_status'] ?? '0') === '0' ? 'selected' : '' ?>>Pasif (Yalnızca IBAN)</option>
                            <option value="1" <?= ($settings['iyzico_status'] ?? '0') === '1' ? 'selected' : '' ?>>Aktif (Kredi Kartı + IBAN)</option>
                        </select>
                    </label>
                </div>
            </div>

            <p style="color: var(--text-muted); font-size: var(--font-xs); line-height: 1.6; margin-bottom: 1rem;">
                İleride İyzico ile doğrudan kredi kartı tahsilatı yapmak istediğinizde API bilgilerinizi buraya girip durumu 'Aktif' yapmanız yeterlidir. Altyapı tüm modülleriyle hazır kurulmuştur.
            </p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">İyzico API Key</label>
                    <input type="text" name="iyzico_api_key" class="form-input" value="<?= e($settings['iyzico_api_key'] ?? '') ?>" placeholder="sandbox-...">
                </div>
                <div class="form-group">
                    <label class="form-label">İyzico Secret Key</label>
                    <input type="password" name="iyzico_secret_key" class="form-input" value="<?= e($settings['iyzico_secret_key'] ?? '') ?>" placeholder="••••••••">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">API Base URL</label>
                <input type="text" name="iyzico_base_url" class="form-input" value="<?= e($settings['iyzico_base_url'] ?? 'https://sandbox-api.iyzipay.com') ?>">
            </div>
        </div>

        <div style="text-align: right; margin-top: 1.5rem;">
            <button type="submit" class="xp-btn-pill-primary" style="padding: 0.75rem 2.25rem; font-size: 0.88rem;">
                AYARLARI KAYDET &rarr;
            </button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>

