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
        
        <!-- 1. Üst Tanıtım Başlığı & Minimal Açıklama -->
        <div class="programs-hero-clean text-center">
            <h1 class="programs-headline" style="font-size: clamp(1.9rem, 3vw, 2.6rem); margin: 0 0 0.5rem; letter-spacing: 0.03em;"><?= e($progHeadline) ?></h1>
            <p class="programs-subheadline" style="max-width: 680px; margin: 0 auto; font-size: 0.92rem; color: #666; line-height: 1.55;">
                <?= e($progLead) ?>
            </p>
        </div>

        <!-- 2. Üyelik Planı Seçimi: Aylık vs Yıllık -->
        <div class="plan-billing-switcher-wrap" style="margin: 1.25rem 0 1.8rem;">
            <div class="plan-billing-switcher" role="tablist" aria-label="Üyelik Süresi Seçimi">
                <button type="button" class="billing-switch-btn active" id="btnMonthlyPlan" data-plan="monthly">
                    Aylık Üyelik
                </button>
                <button type="button" class="billing-switch-btn" id="btnYearlyPlan" data-plan="yearly">
                    Yıllık All-Access <span class="billing-save-badge">%45 İndirim</span>
                </button>
            </div>
            
            <p class="billing-tier-desc" id="billingTierDesc" style="margin-top: 0.5rem;">
                <strong>Aylık Üyelik Modeli:</strong> Seçtiğiniz eğitim paketi ve Fizyobar Kitchen tariflerine 30 gün boyunca erişim sağlar.
            </p>
        </div>

        <!-- 3. Satılacak Eğitim Paketleri Grid (Kompakt & Video Önizlemeli) -->
        <div class="programs-clean-grid" id="programsGrid">
            
            <!-- Eğitim 1: 4 Haftalık Online Detox & Yoga Kampı -->
            <article class="clean-plan-card is-featured" id="detox-camp">
                <div class="featured-badge-pill">EN ÇOK TERCİH EDİLEN</div>

                <!-- Video Önizleme Alanı -->
                <div class="plan-card-video-wrap" data-video-src="<?= asset('assets/videos/hero.mp4') ?>" data-video-title="4 HAFTALIK DETOX &amp; YOGA KAMPI" role="button" tabindex="0" title="Eğitim Tanıtım Videosunu Aç">
                    <video class="plan-preview-video" poster="<?= asset('assets/images/hero-poster.jpg') ?>" autoplay muted loop playsinline preload="metadata">
                        <source src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
                    </video>
                    <div class="plan-video-overlay">
                        <span class="plan-video-badge"><span class="video-pulse-dot"></span> EĞİTİM ÖNİZLEME</span>
                        <button type="button" class="plan-video-play-toggle" aria-label="Eğitim Videosunu Aç">
                            <svg class="icon-play" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"></polygon></svg>
                            <svg class="icon-pause" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="display:none;"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
                        </button>
                    </div>
                </div>

                <div class="plan-card-body">
                    <div class="plan-card-top">
                        <div class="plan-category-tag">PAKET 01 &bull; METABOLİK &amp; YOGA</div>
                        <h2 class="clean-plan-title">4 HAFTALIK DETOX &amp; YOGA KAMPI</h2>
                        <p class="clean-plan-subtitle">Bütünsel Sıfırlama, Biyomekanik Duruş &amp; Yağ Yakımı</p>
                        
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

                    <!-- Kapsam & Özellikler Listesi -->
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
                            <span class="feature-text">Haftada 3 gün modüler video akışlar</span>
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
                </div>
            </article>

            <!-- Eğitim 2: Warrior Yoga Planı -->
            <article class="clean-plan-card" id="warrior">
                <!-- Video Önizleme Alanı -->
                <div class="plan-card-video-wrap" data-video-src="<?= asset('assets/videos/hero.mp4') ?>" data-video-title="WARRIOR YOGA PLANI" role="button" tabindex="0" title="Eğitim Tanıtım Videosunu Aç">
                    <video class="plan-preview-video" poster="<?= asset('assets/images/betina-outdoor-inversion.jpg') ?>" autoplay muted loop playsinline preload="metadata">
                        <source src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
                    </video>
                    <div class="plan-video-overlay">
                        <span class="plan-video-badge"><span class="video-pulse-dot"></span> EĞİTİM ÖNİZLEME</span>
                        <button type="button" class="plan-video-play-toggle" aria-label="Eğitim Videosunu Aç">
                            <svg class="icon-play" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"></polygon></svg>
                            <svg class="icon-pause" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="display:none;"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
                        </button>
                    </div>
                </div>

                <div class="plan-card-body">
                    <div class="plan-card-top">
                        <div class="plan-category-tag">PAKET 02 &bull; GÜÇ &amp; DİNAMİZM</div>
                        <h2 class="clean-plan-title">WARRIOR YOGA PLANI</h2>
                        <p class="clean-plan-subtitle">Dinamik Akış, Calisthenics Kuvvet &amp; Mobilite</p>
                        
                        <div class="clean-plan-price">
                            <span class="price-val" data-monthly="1.250 TL" data-yearly="7.900 TL">1.250 TL</span>
                            <span class="price-note" data-monthly="Aylık üyelik (Kendi paketi + Kitchen dahil)" data-yearly="Yıllık üyelik (Tüm paketler + Beslenme Rehberleri dahil)">Aylık üyelik (Kendi paketi + Kitchen dahil)</span>
                        </div>

                        <div class="package-specs-highlight">
                            <span class="spec-pill"><strong>+12</strong> antrenman</span>
                            <span class="spec-pill"><strong>+28</strong> gün</span>
                            <span class="spec-pill"><strong>%100</strong> ekipmansız</span>
                        </div>
                    </div>

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
                </div>
            </article>

            <!-- Eğitim 3: Omurga & Postür Biyomekaniği -->
            <article class="clean-plan-card" id="posture">
                <!-- Video Önizleme Alanı -->
                <div class="plan-card-video-wrap" data-video-src="<?= asset('assets/videos/hero.mp4') ?>" data-video-title="OMURGA &amp; POSTÜR BİYOMEKANİĞİ" role="button" tabindex="0" title="Eğitim Tanıtım Videosunu Aç">
                    <video class="plan-preview-video" poster="<?= asset('assets/images/betina-studio-forward-fold.jpg') ?>" autoplay muted loop playsinline preload="metadata">
                        <source src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
                    </video>
                    <div class="plan-video-overlay">
                        <span class="plan-video-badge"><span class="video-pulse-dot"></span> EĞİTİM ÖNİZLEME</span>
                        <button type="button" class="plan-video-play-toggle" aria-label="Eğitim Videosunu Aç">
                            <svg class="icon-play" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"></polygon></svg>
                            <svg class="icon-pause" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="display:none;"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
                        </button>
                    </div>
                </div>

                <div class="plan-card-body">
                    <div class="plan-card-top">
                        <div class="plan-category-tag">PAKET 03 &bull; KLİNİK HİZALANMA</div>
                        <h2 class="clean-plan-title">OMURGA &amp; POSTÜR BİYOMEKANİĞİ</h2>
                        <p class="clean-plan-subtitle">Klinik Duruş, Boyun-Bel Dekompresyonu &amp; Fasya</p>
                        
                        <div class="clean-plan-price">
                            <span class="price-val" data-monthly="1.850 TL" data-yearly="7.900 TL">1.850 TL</span>
                            <span class="price-note" data-monthly="Aylık üyelik (Kendi paketi + Kitchen dahil)" data-yearly="Yıllık üyelik (Tüm paketler + Beslenme Rehberleri dahil)">Aylık üyelik (Kendi paketi + Kitchen dahil)</span>
                        </div>

                        <div class="package-specs-highlight">
                            <span class="spec-pill"><strong>+12</strong> antrenman</span>
                            <span class="spec-pill"><strong>+28</strong> gün</span>
                            <span class="spec-pill"><strong>%100</strong> ekipmansız</span>
                        </div>
                    </div>

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
                </div>
            </div>
        </div>

        <!-- 5. Üyeliğin Nasıl İşlediği Bilgilendirme Bölümü -->
        <section class="how-membership-works-section">
            <div class="section-title-wrap text-center">
                <span class="section-kicker">ŞEFFAF &amp; KOLAY SÜREÇ</span>
                <h2 class="section-heading-lg" style="margin-bottom: 0.5rem;">Üyelik Nasıl İşler?</h2>
                <p class="section-lead-muted" style="max-width: 620px; margin: 0 auto 1.75rem;">
                    Fizyobar ile iyi yaşam yolculuğunuza başlamak ve bedeninizi dönüştürmek son derece pratiktir:
                </p>
            </div>

            <div class="membership-steps-grid">
                <div class="membership-step-card">
                    <div class="step-card-header">
                        <span class="step-num-pill">01</span>
                        <span class="step-tag-label">ADIM</span>
                    </div>
                    <h3 class="step-title">Paketini &amp; Planını Seç</h3>
                    <p class="step-desc">
                        İhtiyacınıza en uygun eğitimi belirleyin. Aylık standart plan (paket + Kitchen) veya Yıllık All-Access modelini seçin.
                    </p>
                </div>

                <div class="membership-step-card">
                    <div class="step-card-header">
                        <span class="step-num-pill">02</span>
                        <span class="step-tag-label">ADIM</span>
                    </div>
                    <h3 class="step-title">Hareket Alanına Giriş Yap</h3>
                    <p class="step-desc">
                        Ödemeniz onaylandığı anda kişisel öğrenci paneliniz açılır. 28 günlük antrenman takviminize ve video kütüphanenize hemen erişin.
                    </p>
                </div>

                <div class="membership-step-card">
                    <div class="step-card-header">
                        <span class="step-num-pill">03</span>
                        <span class="step-tag-label">ADIM</span>
                    </div>
                    <h3 class="step-title">12 Antrenman &amp; Kitchen</h3>
                    <p class="step-desc">
                        Haftada 3 gün, %100 ekipmansız seansları evinizde uygulayın. Fizyobar Kitchen'daki fonksiyonel tariflerle dengede kalın.
                    </p>
                </div>

                <div class="membership-step-card">
                    <div class="step-card-header">
                        <span class="step-num-pill">04</span>
                        <span class="step-tag-label">ADIM</span>
                    </div>
                    <h3 class="step-title">Kalıcı Güç &amp; Longevity</h3>
                    <p class="step-desc">
                        İlerleme çubuğunuzu doldurun, omurga mobilitenizi ve kas gücünüzü artırarak ömür boyu sürecek bir alışkanlık kazanın.
                    </p>
                </div>
            </div>
        </section>

        <!-- Video Önizleme Modalı (Lightbox) -->
        <div class="fizyobar-video-modal" id="programVideoModal" aria-hidden="true" role="dialog" aria-labelledby="programVideoTitle">
            <div class="video-modal-backdrop" id="programVideoBackdrop"></div>
            <div class="video-modal-dialog">
                <div class="video-modal-header">
                    <div class="video-modal-title-wrap">
                        <span class="video-modal-kicker">FİZYOBAR ONLINE AKADEMİ &bull; EĞİTİM ÖNİZLEME</span>
                        <h3 class="video-modal-title" id="programVideoTitle">4 HAFTALIK DETOX &amp; YOGA KAMPI</h3>
                    </div>
                    <button type="button" class="video-modal-close" id="programVideoClose" aria-label="Kapat">&times;</button>
                </div>
                <div class="video-modal-player-wrap">
                    <video id="programModalPlayer" controls playsinline preload="auto">
                        <source id="programModalVideoSource" src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
                        Tarayıcınız video etiketini desteklemiyor.
                    </video>
                </div>
            </div>
        </div>

        <!-- 6. Alt Destek ve Kararsız Olanlar İçin Yönlendirme -->
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

    // 2. Video Tanıtım Önizleme Modalı (Lightbox Player)
    const videoModal = document.getElementById('programVideoModal');
    const modalBackdrop = document.getElementById('programVideoBackdrop');
    const modalCloseBtn = document.getElementById('programVideoClose');
    const modalPlayer = document.getElementById('programModalPlayer');
    const modalSource = document.getElementById('programModalVideoSource');
    const modalTitle = document.getElementById('programVideoTitle');
    const videoWraps = document.querySelectorAll('.plan-card-video-wrap');

    function openVideoModal(wrap) {
        if (!videoModal || !modalPlayer) return;

        const title = wrap.getAttribute('data-video-title') || 'EĞİTİM ÖNİZLEME';
        const src = wrap.getAttribute('data-video-src') || '';

        if (modalTitle) {
            modalTitle.textContent = title;
        }

        if (modalSource && src && modalSource.getAttribute('src') !== src) {
            modalSource.setAttribute('src', src);
            modalPlayer.load();
        }

        videoModal.classList.add('is-open');
        videoModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Videoyu sesli olarak başlat
        modalPlayer.muted = false;
        const playPromise = modalPlayer.play();
        if (playPromise !== undefined) {
            playPromise.catch(function(err) {
                console.log('Video autoplay blocked or pending:', err);
            });
        }
    }

    function closeVideoModal() {
        if (!videoModal || !modalPlayer) return;

        videoModal.classList.remove('is-open');
        videoModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';

        modalPlayer.pause();
    }

    videoWraps.forEach(function(wrap) {
        wrap.addEventListener('click', function(e) {
            e.preventDefault();
            openVideoModal(this);
        });

        wrap.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openVideoModal(this);
            }
        });
    });

    if (modalCloseBtn) {
        modalCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeVideoModal();
        });
    }

    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function(e) {
            e.preventDefault();
            closeVideoModal();
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && videoModal && videoModal.classList.contains('is-open')) {
            closeVideoModal();
        }
    });
});
</script>
