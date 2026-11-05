<?php
declare(strict_types=1);
?>

<div class="legal-page">
    <div class="container legal-container">
        <header class="legal-header">
            <span class="legal-badge"><?= __('common.legal_links') ?></span>
            <h1 class="legal-title"><?= __('legal.cookies_title') ?></h1>
            <p class="legal-date"><?= __('legal.last_updated') ?></p>
        </header>

        <article class="legal-body">
            <div class="legal-alert-box">
                <p><strong>Çerez Tercihlerinizi İstediğiniz Zaman Değiştirebilirsiniz:</strong></p>
                <button type="button" id="inPageManageCookies" class="btn btn-primary btn-sm">
                    🍪 <?= __('cookie.customize') ?>
                </button>
            </div>

            <section class="legal-section">
                <h2>1. Çerez (Cookie) Nedir?</h2>
                <p>Çerezler, web sitelerini ziyaret ettiğinizde tarayıcınız aracılığıyla cihazınıza kaydedilen küçük metin dosyalarıdır. Çerezler, web sitemizin güvenli, hızlı ve kişiselleştirilmiş bir şekilde çalışmasını sağlar.</p>
            </section>

            <section class="legal-section">
                <h2>2. Fizyobar Platformunda Kullanılan Çerez Kategorileri</h2>
                
                <div class="cookie-table-wrapper">
                    <table class="legal-table">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Kullanım Amacı</th>
                                <th>Zorunluluk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Zorunlu Çerezler</strong></td>
                                <td>Oturum güvenliği (PHP session), CSRF saldırı koruması, kimlik doğrulama ve dil seçimi.</td>
                                <td><span class="badge badge-success"><?= __('cookie.always_active') ?></span></td>
                            </tr>
                            <tr>
                                <td><strong>Analitik Çerezler</strong></td>
                                <td>Sayfa ziyaret sayıları, sayfa yükleme süreleri ve ziyaretçi hareketlerinin anonim analizi.</td>
                                <td>İsteğe Bağlı</td>
                            </tr>
                            <tr>
                                <td><strong>Pazarlama Çerezleri</strong></td>
                                <td>İlgi alanlarınıza uygun eğitim ve abonelik önerilerinin sunulması.</td>
                                <td>İsteğe Bağlı</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="legal-section">
                <h2>3. Çerezlerin Yönetimi ve Silinmesi</h2>
                <p>Tarayıcınızın ayarlarından veya sitemizde yer alan "Çerez Tercihleri" panelinden dilediğiniz an tercihlerinizi güncelleyebilir, kayıtlı çerezleri silebilirsiniz.</p>
            </section>
        </article>
    </div>
</div>

