<?php
declare(strict_types=1);
?>

<!-- Kurumsal Sayfası Hero -->
<section class="page-editorial-hero">
    <div class="container text-center">
        <span class="section-kicker">KURUMSAL WELLBEING ÇÖZÜMLERİ</span>
        <h1 class="page-editorial-title">Şirketler & Ekipler İçin Bütüncül İyi Yaşam</h1>
        <p class="page-editorial-lead">
            Modern çalışma hayatının getirdiği kronik stresi, omurga problemlerini ve motivasyon kayıplarını; fizyoterapi temelli hareket bilimi, ergonomi ve nefes atölyeleriyle çözüyoruz.
        </p>
    </div>
</section>

<!-- Kurumsal Hizmet Sütunları -->
<section class="corporate-services-section">
    <div class="container">
        <!-- Kurucu Beyanı / Manifestosu -->
        <div class="corporate-quote-frame">
            <blockquote class="corp-quote-text">
                "Ekip sağlığı ve çalışan esenliği bir şirket lüksü değil; sürdürülebilir başarı ve yüksek odaklanma için en kritik yatırımdır."
            </blockquote>
            <cite class="corp-quote-author">— Betina Tansuğ, Fizyoterapist & Fizyobar Kurucusu</cite>
        </div>

        <div class="section-title-wrap text-center" style="margin-top: 4rem;">
            <span class="section-kicker">HİZMET ALANLARIMIZ</span>
            <h2 class="section-heading-lg">Kurumlara Özel Tasarlanan Modüller</h2>
            <p class="section-lead-muted">Şirketinizin ihtiyaçlarına göre şekillendirilen online ve yüz yüze atölyeler.</p>
        </div>

        <div class="corporate-grid-3">
            <!-- 1. Ofis Ergonomisi -->
            <article class="corp-card">
                <span class="corp-card-num">01 /</span>
                <span class="corp-card-tag">OFİS VE ÇALIŞMA ALANI</span>
                <h3 class="corp-card-title">Masa Başı Ergonomi & Omurga Sağlığı</h3>
                <p class="corp-card-desc">
                    Uzun saatler bilgisayar başında oturmanın yarattığı boyun, sırt ve bel gerginliklerini sıfırlayan; iş yerinde kolayca uygulanabilir mikro hareket dizileri ve doğru oturma eğitimi.
                </p>
            </article>

            <!-- 2. Lansman & Etkinlik -->
            <article class="corp-card corp-card-accent">
                <span class="corp-card-num">02 /</span>
                <span class="corp-card-tag tag-bordo">MARKA VE ETKİNLİK</span>
                <h3 class="corp-card-title">Kurumsal Lansman & Wellness Seansları</h3>
                <p class="corp-card-desc">
                    Markanızın prestijine uygun açık hava festivalleri, basın lansmanları, şirket offsite buluşmaları veya özel davetlerde ilham verici grup yoga ve meditasyon deneyimleri.
                </p>
            </article>

            <!-- 3. Stres Yönetimi -->
            <article class="corp-card">
                <span class="corp-card-num">03 /</span>
                <span class="corp-card-tag">YÖNETİCİ & EKİP</span>
                <h3 class="corp-card-title">Sinir Sistemi & Stres Regülasyonu</h3>
                <p class="corp-card-desc">
                    Yüksek baskı altında çalışan ekipler ve liderler için vagus siniri uyarımı, diyafram nefesi mekaniği ve zihinsel berraklık kazandıran somatik stres yönetimi atölyesi.
                </p>
            </article>
        </div>

        <!-- Kurumsal Teklif ve İletişim Formu -->
        <div class="corporate-form-container" id="teklif-formu">
            <div class="form-header-wrap text-center">
                <span class="section-kicker">İŞ BİRLİĞİ VE TEKLİF</span>
                <h3 class="form-main-title">Şirketiniz İçin Özel Bir Program Planlayalım</h3>
                <p class="form-sub-lead">Ekip büyüklüğünüzü ve hedefinizi belirtin, size en uygun atölye içeriğini birlikte oluşturalım.</p>
            </div>

            <?php if (isset($flashSuccess)): ?>
                <div class="alert-success-box">
                    ✓ <?= e($flashSuccess) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/corporate/submit') ?>" method="POST" class="corp-form">
                <?= csrf_field() ?>

                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="corp_name">Yetkili Adı Soyadı *</label>
                        <input type="text" id="corp_name" name="name" class="form-control" required placeholder="Adınız Soyadınız">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="corp_company">Şirket / Marka Adı *</label>
                        <input type="text" id="corp_company" name="company" class="form-control" required placeholder="Şirketinizin Ünvanı">
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="corp_email">Kurumsal E-posta Adresi *</label>
                        <input type="email" id="corp_email" name="email" class="form-control" required placeholder="adiniz@sirketiniz.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="corp_phone">Telefon Numarası *</label>
                        <input type="tel" id="corp_phone" name="phone" class="form-control" required placeholder="05XX XXX XX XX">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="corp_message">Etkinlik / Talep Detayları *</label>
                    <textarea id="corp_message" name="message" class="form-control form-textarea" rows="4" required placeholder="Planlanan tarih, katılımcı sayısı (tahmini) ve arzu ettiğiniz konsept hakkında kısa bilgi veriniz..."></textarea>
                </div>

                <div class="form-submit-wrap text-center">
                    <button type="submit" class="btn-pill-solid-dark">
                        TEKLİF TALEBİNİ GÖNDER &rarr;
                    </button>
                    <div class="form-direct-wa">
                        veya doğrudan kurumsal WhatsApp hattından ulaşın:
                        <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20kurumsal%20wellbeing%20ve%20at%C3%B6lye%20teklifi%20almak%20istiyorum." target="_blank" rel="noopener noreferrer">
                            <?= __('brand.phone_display') ?>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
