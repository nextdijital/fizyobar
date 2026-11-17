<?php
declare(strict_types=1);
$progData = function_exists('page_data') ? page_data('programs') : [];

$progKicker = $progData['prog_hero_kicker'] ?? 'KLİNİK FİZYOTERAPİ • KALİSTHENİCS YOGA';
$progHeadline = $progData['prog_hero_title'] ?? 'EĞİTİM & DÖNÜŞÜM PAKETLERİ';
$progLead = $progData['prog_hero_lead'] ?? 'Fizyoterapist Betina Tansuğ metodolojisiyle bedeninize kalıcı fonksiyon, anatomik güç ve estetik denge kazandıran 28 günlük bilimsel programlar:';

$quotaPercent = (int)($progData['prog_quota_percent'] ?? 87);
$quotaLeft = (int)($progData['prog_quota_left'] ?? 8);
$quotaBtnText = $progData['prog_quota_btn_text'] ?? '500+ YOGİ ARASINA KATIL →';
$quotaBtnLink = $progData['prog_quota_btn_link'] ?? '#programsGrid';
if (!empty($quotaBtnLink) && !str_starts_with($quotaBtnLink, '#') && !str_starts_with($quotaBtnLink, 'http') && !str_starts_with($quotaBtnLink, '/fizyobar')) {
    $quotaBtnLink = url($quotaBtnLink);
}

$trans1Before = !empty($progData['prog_trans1_before']) ? $progData['prog_trans1_before'] : 'assets/images/trans-1-before.webp';
$trans1After = !empty($progData['prog_trans1_after']) ? $progData['prog_trans1_after'] : 'assets/images/trans-1-after.webp';
if (!str_starts_with($trans1Before, 'http') && !str_starts_with($trans1Before, '/fizyobar')) $trans1Before = asset(ltrim($trans1Before, '/'));
if (!str_starts_with($trans1After, 'http') && !str_starts_with($trans1After, '/fizyobar')) $trans1After = asset(ltrim($trans1After, '/'));

$trans2Before = !empty($progData['prog_trans2_before']) ? $progData['prog_trans2_before'] : 'assets/images/trans-2-before.webp';
$trans2After = !empty($progData['prog_trans2_after']) ? $progData['prog_trans2_after'] : 'assets/images/trans-2-after.webp';
if (!str_starts_with($trans2Before, 'http') && !str_starts_with($trans2Before, '/fizyobar')) $trans2Before = asset(ltrim($trans2Before, '/'));
if (!str_starts_with($trans2After, 'http') && !str_starts_with($trans2After, '/fizyobar')) $trans2After = asset(ltrim($trans2After, '/'));

$trans3Before = !empty($progData['prog_trans3_before']) ? $progData['prog_trans3_before'] : 'assets/images/trans-3-before.webp';
$trans3After = !empty($progData['prog_trans3_after']) ? $progData['prog_trans3_after'] : 'assets/images/trans-3-after.webp';
if (!str_starts_with($trans3Before, 'http') && !str_starts_with($trans3Before, '/fizyobar')) $trans3Before = asset(ltrim($trans3Before, '/'));
if (!str_starts_with($trans3After, 'http') && !str_starts_with($trans3After, '/fizyobar')) $trans3After = asset(ltrim($trans3After, '/'));
?>

<!-- ==============================================================================
     EĞİTİM & DÖNÜŞÜM PROGRAMLARI SAYFASI
     Klinik Fizyoterapi, Biyomekanik ve Kalisthenics Yoga Eğitim Paketleri
     ============================================================================== -->
<section class="programs-clean-section">
    <div class="container">
        
        <!-- 1. Üst Tanıtım & Canlı Kontenjan Doluluk Barı -->
        <div class="programs-hero-clean text-center">
            <span class="programs-kicker-pill" style="color: #391214; font-weight: 700; letter-spacing: 0.12em; font-size: 0.76rem;"><?= e($progKicker) ?></span>
            <h1 class="programs-headline" style="font-size: clamp(1.9rem, 3vw, 2.6rem); margin: 0.35rem 0 0.5rem; letter-spacing: 0.03em;"><?= e($progHeadline) ?></h1>
            <p class="programs-subheadline" style="max-width: 680px; margin: 0 auto; font-size: 0.92rem; color: #666; line-height: 1.55;">
                <?= e($progLead) ?>
            </p>

            <!-- Canlı Kontenjan Göstergesi ve 500+ Kalisthenics Yogi Butonu (Yatay Kompakt Bar) -->
            <div class="quota-occupancy-card" style="max-width: 860px; margin: 1.25rem auto 1.5rem; text-align: left;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 10px; flex: 1; min-width: 250px;">
                        <span class="quota-badge" style="white-space: nowrap;">
                            <span class="quota-pulse-dot"></span> CANLI KONTENJAN: <strong style="color: #391214;">%<?= $quotaPercent ?> DOLU</strong>
                        </span>
                        <div class="quota-bar-track" style="flex: 1; min-width: 90px;">
                            <div class="quota-bar-fill" style="width: <?= min(100, max(0, $quotaPercent)) ?>%;"></div>
                        </div>
                        <span class="quota-count" style="white-space: nowrap;">Son <strong><?= $quotaLeft ?></strong> Kişi</span>
                    </div>
                    <a href="<?= e($quotaBtnLink) ?>" class="btn-yogi-cta">
                        <?= e($quotaBtnText) ?>
                    </a>
                </div>
            </div>

            <!-- Canlı Kamp Sayfası Çağrısı (Minimal Gri-Bordo Çizgi) -->
            <div style="font-size: 0.82rem; color: #666; margin-top: 0.4rem;">
                <span style="background: #391214; color: #fff; font-size: 0.65rem; font-weight: 800; padding: 2px 7px; border-radius: 4px; letter-spacing: 0.05em; margin-right: 5px;">CANLI KAMP</span>
                Birebir WhatsApp takipli ve beslenmeli 4 haftalık dönem:
                <a href="<?= url('/detox') ?>" style="color: #391214; font-weight: 700; text-decoration: underline; margin-left: 3px;">
                    Online Detox &amp; Yoga Kampı Sayfası &rarr;
                </a>
            </div>
        </div>

        <!-- 2. Üyelik Planı Seçimi: Aylık vs Yıllık -->
        <div class="plan-billing-switcher-wrap">
            <div class="plan-billing-switcher" role="tablist" aria-label="Üyelik Süresi Seçimi">
                <button type="button" class="billing-switch-btn active" id="btnMonthlyPlan" data-plan="monthly">
                    Aylık Üyelik
                </button>
                <button type="button" class="billing-switch-btn" id="btnYearlyPlan" data-plan="yearly">
                    Yıllık All-Access <span class="billing-save-badge">%45 İndirim</span>
                </button>
            </div>
            
            <p class="billing-tier-desc" id="billingTierDesc">
                <strong>Aylık Üyelik Modeli:</strong> Seçtiğiniz eğitim paketi ve Fizyobar Kitchen tariflerine 30 gün boyunca erişim sağlar.
            </p>
        </div>

        <!-- 3. Satılacak Eğitim Paketleri Grid (Kompakt, Dengeli & Minimal) -->
        <div class="programs-clean-grid" id="programsGrid">
            
            <!-- Eğitim 1: 4 Haftalık Online Detox & Yoga Kampı (Ana Paket) -->
            <article class="clean-plan-card is-featured" id="detox-camp">
                <div class="featured-badge-pill">EN ÇOK TERCİH EDİLEN</div>
                
                <div class="plan-card-top">
                    <div class="plan-category-tag">PAKET 01 &bull; METABOLİK &amp; YOGA</div>
                    <h2 class="clean-plan-title">4 HAFTALIK ONLİNE<br>DETOX &amp; YOGA KAMPI</h2>
                    <p class="clean-plan-subtitle">Bütünsel Metabolik Sıfırlama, Biyomekanik Duruş &amp; Yağ Yakımı</p>
                    
                    <!-- Fiyat Alanı -->
                    <div class="clean-plan-price">
                        <span class="price-val" data-monthly="1.850 TL" data-yearly="7.900 TL">1.850 TL</span>
                        <span class="price-note" data-monthly="Aylık üyelik (Kendi paketi + Kitchen dahil)" data-yearly="Yıllık üyelik (Tüm paketler + Beslenme Rehberleri dahil)">Aylık üyelik (Kendi paketi + Kitchen dahil)</span>
                    </div>

                    <!-- Paket Özellikleri Hapı -->
                    <div class="package-specs-highlight">
                        <span class="spec-pill"><strong>+12</strong> antrenman</span>
                        <span class="spec-pill"><strong>+28</strong> gün</span>
                        <span class="spec-pill"><strong>%100</strong> ekipmansız</span>
                    </div>
                </div>

                <!-- Kapsam & Özellikler Listesi (Kompakt Tek Liste) -->
                <div class="clean-features-list">
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Rafine şekersiz glisemik denge &amp; ödem atımı</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Servikal &amp; torakal omurga dekompresyonu</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Haftada 3 gün modüler akış (Pzt - Çar - Cum)</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Fizyobar Kitchen bütünsel tarif kütüphanesi</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Fizyoterapist birebir WhatsApp takibi &amp; kontrolü</span>
                    </div>
                    <div class="clean-feature-item yearly-only-feature" style="display: none; background: #faf5f5; border: 1px solid #ebd4d4; padding: 4px 8px; border-radius: 6px;">
                        <span class="betella-check" style="color: #391214;">★</span>
                        <span class="feature-text"><strong>Tüm Beslenme Rehberleri &amp; E-Kitaplar Dahil</strong></span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/1') ?>" class="btn-clean-plan btn-featured btn-checkout-link" data-base-url="<?= url('/checkout/1') ?>">
                        PROGRAMA KATIL &rarr;
                    </a>
                </div>
            </article>

            <!-- Eğitim 2: Warrior Yoga Planı -->
            <article class="clean-plan-card" id="warrior">
                <div class="plan-card-top">
                    <div class="plan-category-tag">PAKET 02 &bull; GÜÇ &amp; DİNAMİZM</div>
                    <h2 class="clean-plan-title">WARRIOR YOGA<br>PLANI</h2>
                    <p class="clean-plan-subtitle">Dinamik Akış, Calisthenics Kuvvet &amp; Omurga Stabilitesi</p>
                    
                    <div class="clean-plan-price">
                        <span class="price-val" data-monthly="1.250 TL" data-yearly="7.900 TL">1.250 TL</span>
                        <span class="price-note" data-monthly="Aylık üyelik (Kendi paketi + Kitchen dahil)" data-yearly="Yıllık üyelik (Tüm paketler + Beslenme Rehberleri dahil)">Aylık üyelik (Kendi paketi + Kitchen dahil)</span>
                    </div>

                    <!-- Paket Özellikleri Hapı -->
                    <div class="package-specs-highlight">
                        <span class="spec-pill"><strong>+12</strong> antrenman</span>
                        <span class="spec-pill"><strong>+28</strong> gün</span>
                        <span class="spec-pill"><strong>%100</strong> ekipmansız</span>
                    </div>
                </div>

                <!-- Kapsam & Özellikler Listesi (Kompakt Tek Liste) -->
                <div class="clean-features-list">
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Calisthenics eklem dostu vücut ağırlığı gücü</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Kalça ve omuz kuşağı dinamik mobilitesi</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Pelvik taban ve core stabilitesi akışları</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Haftada 3 gün fonksiyonel modüler seanslar</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Fizyobar Kitchen tarif kütüphanesi erişimi</span>
                    </div>
                    <div class="clean-feature-item yearly-only-feature" style="display: none; background: #faf5f5; border: 1px solid #ebd4d4; padding: 4px 8px; border-radius: 6px;">
                        <span class="betella-check" style="color: #391214;">★</span>
                        <span class="feature-text"><strong>Tüm Beslenme Rehberleri &amp; E-Kitaplar Dahil</strong></span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/2') ?>" class="btn-clean-plan btn-checkout-link" data-base-url="<?= url('/checkout/2') ?>">
                        PROGRAMA KATIL &rarr;
                    </a>
                </div>
            </article>

            <!-- Eğitim 3: Omurga & Postür Biyomekaniği -->
            <article class="clean-plan-card" id="posture">
                <div class="plan-card-top">
                    <div class="plan-category-tag">PAKET 03 &bull; KLİNİK HİZALANMA</div>
                    <h2 class="clean-plan-title">OMURGA &amp; POSTÜR<br>BİYOMEKANİĞİ</h2>
                    <p class="clean-plan-subtitle">Klinik Duruş, Boyun-Bel Dekompresyonu &amp; Fasya</p>
                    
                    <div class="clean-plan-price">
                        <span class="price-val" data-monthly="1.850 TL" data-yearly="7.900 TL">1.850 TL</span>
                        <span class="price-note" data-monthly="Aylık üyelik (Kendi paketi + Kitchen dahil)" data-yearly="Yıllık üyelik (Tüm paketler + Beslenme Rehberleri dahil)">Aylık üyelik (Kendi paketi + Kitchen dahil)</span>
                    </div>

                    <!-- Paket Özellikleri Hapı -->
                    <div class="package-specs-highlight">
                        <span class="spec-pill"><strong>+12</strong> antrenman</span>
                        <span class="spec-pill"><strong>+28</strong> gün</span>
                        <span class="spec-pill"><strong>%100</strong> ekipmansız</span>
                    </div>
                </div>

                <!-- Kapsam & Özellikler Listesi (Kompakt Tek Liste) -->
                <div class="clean-features-list">
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">İleri baş ve kifoz (kamburluk) eliminasyonu</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Servikal &amp; torakal omurga dekompresyonu</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Kürek kemiği ve omuz eklemi stabilizasyonu</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Masa başı çalışanlar için günlük mikro seanslar</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check">✓</span>
                        <span class="feature-text">Fizyobar Kitchen tarif kütüphanesi erişimi</span>
                    </div>
                    <div class="clean-feature-item yearly-only-feature" style="display: none; background: #faf5f5; border: 1px solid #ebd4d4; padding: 4px 8px; border-radius: 6px;">
                        <span class="betella-check" style="color: #391214;">★</span>
                        <span class="feature-text"><strong>Tüm Beslenme Rehberleri &amp; E-Kitaplar Dahil</strong></span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/3') ?>" class="btn-clean-plan btn-checkout-link" data-base-url="<?= url('/checkout/3') ?>">
                        PROGRAMA KATIL &rarr;
                    </a>
                </div>
            </article>

        </div>

        <!-- 4. Hediye 3'lü Meditasyon Paketi Modülü (Sayfada Kilitli - Satın Alımla Açılır) -->
        <div class="bonus-meditation-card">
            <div class="bonus-ribbon">🎁 ÖZEL HEDİYE BONUS</div>
            <div class="bonus-content">
                <div class="bonus-lock-icon" title="Satın alımla kilit açılır">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <div style="flex: 1;">
                    <span class="bonus-kicker">PROGRAMA DEĞER KATAN HEDİYE SERİ (DEĞERİ ₺750)</span>
                    <h3 class="bonus-title">3'lü Meditasyon &amp; Vagus Sinir Regülasyonu</h3>
                    <p class="bonus-desc">
                        Bu sayfadaki paketlerden herhangi birine kayıt olduğunuzda, derin uyku ve stres regülasyonu sağlayan bu 3 özel seans <strong>öğrenci panelinizde ücretsiz ve otomatik olarak açılır</strong>.
                    </p>
                    
                    <div class="bonus-lessons-grid">
                        <div class="bonus-lesson-item">
                            <span class="lesson-num">01</span>
                            <span class="lesson-name">Vagus &amp; Derin Uyku Meditasyonu (15 Dk)</span>
                        </div>
                        <div class="bonus-lesson-item">
                            <span class="lesson-num">02</span>
                            <span class="lesson-name">Sabah Berraklığı &amp; Diyafram Nefesi (15 Dk)</span>
                        </div>
                        <div class="bonus-lesson-item">
                            <span class="lesson-num">03</span>
                            <span class="lesson-name">Kortizol Düşürücü Akşam Sıfırlaması (20 Dk)</span>
                        </div>
                    </div>

                    <div style="margin-top: 0.8rem;">
                        <span class="lock-status-badge">
                            🔒 Sayfada Kilitli &bull; Programa Katılan Tüm Üyelerimize Otomatik Olarak Açılır
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Üyeliğin Nasıl İşlediği Bilgilendirme Bölümü -->
        <section class="how-membership-works-section">
            <div class="section-title-wrap text-center">
                <span class="section-kicker">ŞEFFAF &amp; KOLAY SÜREÇ</span>
                <h2 class="section-heading-lg" style="margin-bottom: 0.6rem;">Üyelik Nasıl İşler?</h2>
                <p class="section-lead-muted" style="max-width: 640px; margin: 0 auto;">
                    Fizyobar ile iyi yaşam yolculuğunuza başlamak ve bedeninizi dönüştürmek son derece pratiktir:
                </p>
            </div>

            <div class="membership-steps-grid">
                <div class="membership-step-card">
                    <span class="step-badge">ADIM 01</span>
                    <h3 class="step-title">Paketini &amp; Planını Seç</h3>
                    <p class="step-desc">
                        İhtiyacınıza en uygun eğitimi belirleyin. Aylık standart plan (paket + Kitchen) veya Yıllık All-Access (tüm eğitimler + beslenme rehberleri) modelini seçin.
                    </p>
                </div>

                <div class="membership-step-card">
                    <span class="step-badge">ADIM 02</span>
                    <h3 class="step-title">Hareket Alanına Giriş Yap</h3>
                    <p class="step-desc">
                        Ödemeniz onaylandığı anda kişisel öğrenci paneliniz açılır. 28 günlük antrenman takviminize, video kütüphanenize ve hediye meditasyon paketinize hemen erişin.
                    </p>
                </div>

                <div class="membership-step-card">
                    <span class="step-badge">ADIM 03</span>
                    <h3 class="step-title">12 Antrenman &amp; Kitchen</h3>
                    <p class="step-desc">
                        Haftada 3 gün, %100 ekipmansız seansları evinizde uygulayın. Fizyobar Kitchen'daki fonksiyonel tariflerle kan şekerinizi ve metabolizmanızı dengede tutun.
                    </p>
                </div>

                <div class="membership-step-card">
                    <span class="step-badge">ADIM 04</span>
                    <h3 class="step-title">Kalıcı Güç &amp; Longevity</h3>
                    <p class="step-desc">
                        İlerleme çubuğunuzu doldurun, omurga mobilitenizi ve kas dayanıklılığınızı artırarak ömür boyu sürecek kalıcı bir yaşam alışkanlığı kazanın.
                    </p>
                </div>
            </div>
        </section>

        <!-- 6. 2 Kategoride Before / After Bölümü (Güç Dönüşümleri / İncelme Dönüşümleri) -->
        <section class="programs-transformations-section" style="margin: 4.5rem 0 2rem;">
            <div class="section-title-wrap text-center">
                <span class="section-kicker">KANITLANMIŞ SONUÇLAR</span>
                <h2 class="section-heading-lg" style="margin-bottom: 0.6rem;">Dönüşüm Hikayeleri</h2>
                <p class="section-lead-muted" style="max-width: 680px; margin: 0 auto;">
                    Fizyobar katılımcılarımızın 28 günde elde ettiği somut biyomekanik ve metabolik sonuçlar. Kategoriye göre filtreleyebilir veya karta tıklayarak Öncesi/Sonrası arasında geçiş yapabilirsiniz:
                </p>

                <!-- Kategori Filtresi -->
                <div class="trans-cat-filter-tabs">
                    <button type="button" class="trans-tab-btn active" data-filter="all">TÜMÜ (6)</button>
                    <button type="button" class="trans-tab-btn" data-filter="power">⚡ GÜÇ DÖNÜŞÜMLERİ (3)</button>
                    <button type="button" class="trans-tab-btn" data-filter="slim">✨ İNCELME DÖNÜŞÜMLERİ (3)</button>
                </div>
            </div>

            <div class="transformation-slider-viewport" style="margin-top: 1.5rem;">
                <div class="transformation-track" id="programsTransTrack" style="justify-content: center; flex-wrap: wrap; gap: 1.5rem;">
                    
                    <!-- Vaka 1 (Güç) -->
                    <div class="trans-card is-active" data-category="power" style="cursor: pointer;">
                        <span class="trans-category-tag">⚡ GÜÇ &amp; OMURGA</span>
                        <div class="card-inner">
                            <div class="card-face card-front">
                                <img src="<?= e($trans1Before) ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-before">ÖNCESİ</span>
                            </div>
                            <div class="card-face card-back">
                                <img src="<?= e($trans1After) ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-after">SONRASI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vaka 2 (Güç) -->
                    <div class="trans-card" data-category="power" style="cursor: pointer;">
                        <span class="trans-category-tag">⚡ CORE &amp; KALİSTHENİCS</span>
                        <div class="card-inner">
                            <div class="card-face card-front">
                                <img src="<?= e($trans2Before) ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-before">ÖNCESİ</span>
                            </div>
                            <div class="card-face card-back">
                                <img src="<?= e($trans2After) ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-after">SONRASI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vaka 3 (Güç) -->
                    <div class="trans-card" data-category="power" style="cursor: pointer;">
                        <span class="trans-category-tag">⚡ POSTÜR HİZALANMASI</span>
                        <div class="card-inner">
                            <div class="card-face card-front">
                                <img src="<?= e($trans3Before) ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-before">ÖNCESİ</span>
                            </div>
                            <div class="card-face card-back">
                                <img src="<?= e($trans3After) ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-after">SONRASI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vaka 4 (İncelme) -->
                    <div class="trans-card" data-category="slim" style="cursor: pointer;">
                        <span class="trans-category-tag">✨ İNCELME &amp; BEL</span>
                        <div class="card-inner">
                            <div class="card-face card-front">
                                <img src="<?= asset('assets/images/transformation-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-before">ÖNCESİ</span>
                            </div>
                            <div class="card-face card-back">
                                <img src="<?= asset('assets/images/transformation-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-after">SONRASI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vaka 5 (İncelme) -->
                    <div class="trans-card" data-category="slim" style="cursor: pointer;">
                        <span class="trans-category-tag">✨ ÖDEM &amp; METABOLİK DETOKS</span>
                        <div class="card-inner">
                            <div class="card-face card-front">
                                <img src="<?= asset('assets/images/trans-2-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-before">ÖNCESİ</span>
                            </div>
                            <div class="card-face card-back">
                                <img src="<?= asset('assets/images/trans-2-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-after">SONRASI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vaka 6 (İncelme) -->
                    <div class="trans-card" data-category="slim" style="cursor: pointer;">
                        <span class="trans-category-tag">✨ SIKILAŞMA &amp; GLİSEMİK DENGE</span>
                        <div class="card-inner">
                            <div class="card-face card-front">
                                <img src="<?= asset('assets/images/trans-1-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-before">ÖNCESİ</span>
                            </div>
                            <div class="card-face card-back">
                                <img src="<?= asset('assets/images/trans-1-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                                <span class="card-status-badge badge-after">SONRASI</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 7. Alt Destek ve Kararsız Olanlar İçin Yönlendirme -->
        <div class="programs-minimal-footer text-center" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #e5e5e5;">
            <p style="font-size: 0.92rem; color: #666666;">
                Hangi eğitimin bedeninize en uygun olduğu konusunda emin değil misiniz?
                <a href="<?= url('/programini-bul') ?>" class="footer-finder-link" style="color: #391214; font-weight: 700; text-decoration: underline;">
                    Yapay Zeka ile Beden Analizinizi Yapın &rarr;
                </a>
            </p>
        </div>

    </div>
</section>

<!-- Etkileşim Scriptleri: Aylık/Yıllık Toggle ve Before/After Filtresi -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Aylık vs Yıllık Plan Switcher
    const btnMonthly = document.getElementById('btnMonthlyPlan');
    const btnYearly = document.getElementById('btnYearlyPlan');
    const desc = document.getElementById('billingTierDesc');
    const priceVals = document.querySelectorAll('.clean-plan-price .price-val');
    const priceNotes = document.querySelectorAll('.clean-plan-price .price-note');
    const yearlyFeatures = document.querySelectorAll('.yearly-only-feature');
    const checkoutLinks = document.querySelectorAll('.btn-checkout-link');

    function setBillingPlan(plan) {
        if (plan === 'yearly') {
            btnYearly.classList.add('active');
            btnMonthly.classList.remove('active');
            if (desc) {
                desc.innerHTML = '<strong>Yıllık All-Access Modeli:</strong> Platformdaki TÜM eğitim paketleri, Fizyobar Kitchen, Bütünsel Beslenme Rehberleri ve 3\'lü Meditasyon Hediyesi 1 yıl boyunca sınırsız açılır.';
            }
            priceVals.forEach(function(el) {
                el.textContent = el.getAttribute('data-yearly') || '7.900 TL';
            });
            priceNotes.forEach(function(el) {
                el.textContent = el.getAttribute('data-yearly') || 'Yıllık üyelik (Her şey açık + Beslenme Rehberleri dahil)';
            });
            yearlyFeatures.forEach(function(el) {
                el.style.display = 'flex';
            });
            checkoutLinks.forEach(function(link) {
                const base = link.getAttribute('data-base-url');
                link.setAttribute('href', base + '?plan=yearly');
            });
        } else {
            btnMonthly.classList.add('active');
            btnYearly.classList.remove('active');
            if (desc) {
                desc.innerHTML = '<strong>Aylık Üyelik Modeli:</strong> Seçtiğiniz eğitim paketi ve Fizyobar Kitchen tariflerine 30 gün boyunca erişim sağlar.';
            }
            priceVals.forEach(function(el) {
                el.textContent = el.getAttribute('data-monthly');
            });
            priceNotes.forEach(function(el) {
                el.textContent = el.getAttribute('data-monthly');
            });
            yearlyFeatures.forEach(function(el) {
                el.style.display = 'none';
            });
            checkoutLinks.forEach(function(link) {
                const base = link.getAttribute('data-base-url');
                link.setAttribute('href', base + '?plan=monthly');
            });
        }
    }

    if (btnMonthly && btnYearly) {
        btnMonthly.addEventListener('click', function() { setBillingPlan('monthly'); });
        btnYearly.addEventListener('click', function() { setBillingPlan('yearly'); });
    }

    // 2. Before / After Kategori Filtresi (Güç vs İncelme)
    const filterTabs = document.querySelectorAll('.trans-tab-btn');
    const transCards = document.querySelectorAll('#programsTransTrack .trans-card');

    filterTabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            filterTabs.forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            const targetFilter = this.getAttribute('data-filter');

            transCards.forEach(function(card) {
                const cardCat = card.getAttribute('data-category');
                if (targetFilter === 'all' || cardCat === targetFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 3. Kart Tıklamalarında Öncesi/Sonrası Çevirme Efekti
    transCards.forEach(function(card) {
        card.addEventListener('click', function() {
            this.classList.toggle('is-flipped');
        });
    });
});
</script>
