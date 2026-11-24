<?php
declare(strict_types=1);
?>

<!-- 1. Hero / Karşılama Alanı (Kenarlıksız Full-Bleed Video Banner & Ortalanmış Tipografi) -->
<section class="hero-video-section">
    <div class="hero-video-container">
        <video class="hero-media-video" autoplay loop muted playsinline poster="<?= asset('assets/images/hero-poster.jpg') ?>">
            <source src="<?= asset('assets/videos/hero.webm') ?>" type="video/webm">
            <source src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
        </video>
        <div class="hero-video-scrim"></div>
    </div>

    <div class="container hero-content-container">
        <div class="hero-center-block">
            <span class="hero-badge-kicker">WELLNESS EXPERIENCES BY BETINA TANSUĞ</span>
            
            <h1 class="hero-display-title">
                BEDENİNLE YENİDEN<br>
                BAĞ KUR.
            </h1>

            <div class="hero-action-buttons">
                <a href="<?= url('/programini-bul') ?>" class="btn-pill-solid">
                    PROGRAMINI BUL
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. Bar System'i Keşfet Alanı (Yüzen Ada Kartı) -->
<section class="bar-system-discover-section" aria-label="BAR System'i Keşfet">
    <div class="container discover-main-container">
        <div class="bar-system-discover-inner">
            <div class="bar-system-discover-content">
                <span class="bar-system-discover-kicker">BAR SYSTEM METODOLOJİSİ</span>
                <h2 class="bar-system-discover-title">BAR SYSTEM'İ KEŞFET</h2>
                <p class="bar-system-discover-lead">
                    Klinik fizyoterapi ilkeleri ve yoga disipliniyle bedeni zorlamadan, anatomik sınırlarını koruyarak güçlendiren ve longevity odaklı kalıcı bir yaşam disiplini sunan patentli yaklaşımımız.
                </p>
            </div>
            <div class="bar-system-discover-action">
                <a href="<?= url('/metod') ?>" class="bar-system-discover-btn">
                    <span>BAR SYSTEM'İ KEŞFET</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. Hedefine Uygun Programını Seç (Bar System Alanı) -->
<section class="three-programs-section" id="bar-system">
    <div class="container three-programs-container">
        <div class="three-programs-header text-center">
            <span class="three-programs-kicker">P R O G R A M L A R</span>
            <h2 class="three-programs-title">Hedefine Uygun Programını Seç</h2>
            <p class="three-programs-subtitle">Bütünsel, sürdürülebilir ve güçlü bir beden için tasarlandı.</p>
        </div>

        <div class="three-programs-grid">
            <!-- Program 1: Calisthenics Yoga -->
            <a href="<?= url('/programs#calisthenics-yoga') ?>" class="three-program-card">
                <img src="<?= asset('assets/images/betina-studio-forward-fold.jpg') ?>" alt="Calisthenics Yoga" class="three-program-card-img" loading="lazy">
                <div class="three-program-card-overlay"></div>
                <div class="three-program-card-content">
                    <div class="three-program-card-head">
                        <h3 class="three-program-card-title">Calisthenics<br>Yoga</h3>
                        <p class="three-program-card-desc">Güç, esneklik ve kontrolü bir arada geliştir.</p>
                    </div>
                    <div class="three-program-card-action">
                        <div class="three-program-arrow-btn">
                            <span>&rarr;</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Program 2: Lean Body -->
            <a href="<?= url('/programs#lean-body') ?>" class="three-program-card">
                <img src="<?= asset('assets/images/transformation-after.webp') ?>" alt="Lean Body" class="three-program-card-img" loading="lazy">
                <div class="three-program-card-overlay"></div>
                <div class="three-program-card-content">
                    <div class="three-program-card-head">
                        <h3 class="three-program-card-title">Lean<br>Body</h3>
                        <p class="three-program-card-desc">Daha fit, güçlü ve tanımlı bir beden inşa et.</p>
                    </div>
                    <div class="three-program-card-action">
                        <div class="three-program-arrow-btn">
                            <span>&rarr;</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Program 3: BAR Mobility -->
            <a href="<?= url('/programs#bar-mobility') ?>" class="three-program-card">
                <img src="<?= asset('assets/images/betina-outdoor-stretch.jpg') ?>" alt="BAR Mobility" class="three-program-card-img" loading="lazy">
                <div class="three-program-card-overlay"></div>
                <div class="three-program-card-content">
                    <div class="three-program-card-head">
                        <h3 class="three-program-card-title">BAR<br>Mobility</h3>
                        <p class="three-program-card-desc">Hareket açıklığını artır, daha özgür ve dengeli hisset.</p>
                    </div>
                    <div class="three-program-card-action">
                        <div class="three-program-arrow-btn">
                            <span>&rarr;</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- 4. Bölüm I: YAKLAŞIMIMIZ (ABOUT - 2 Kolonlu Mimari Grid & Minimalist Saf Beyaz) -->
<section class="editorial-about-section" id="metod">
    <div class="container editorial-about-inner">
        <div class="editorial-about-grid">
            <!-- Sol Kolon: Başlık -->
            <div class="about-title-col">
                <h2 class="about-headline">KLASİK DERSLERİN ÖTESİNDE:</h2>
            </div>
            
            <!-- Sağ Kolon: Açıklayıcı ve Sade Metinler -->
            <div class="about-text-col">
                <p class="lead-paragraph">
                    Fizyoterapist kimliğim sayesinde insan bedenini anatomik, biyomekanik ve fonksiyonel açıdan ele alıyor; yoga pratiğini kanıta dayalı bilimsel bir temele oturtuyorum.
                </p>
                <p class="secondary-paragraph">
                    Hareketi dönemsel bir heves değil; omurga sağlığını, eklem mobilitesini ve sinir sistemi dengesini koruyan, uzun ve ağrısız bir ömür için kalıcı bir yaşam disiplini haline getiriyoruz.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 5. BAR System 3 Adımlı Kayıt & Katılım Süreci (Sticky Pinned Organik Akış & Scroll Çizim Animasyonu) -->
<div class="methodology-flow-sticky-wrap" id="flowStickyWrap">
    <section class="methodology-flow-section" id="metodoloji-akisi">
        <div class="container flow-header-wrap text-center">
            <h2 class="section-heading-lg" style="letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 0.4rem;">3 ADIMDA BAŞLA</h2>
            <p class="section-lead-muted" style="margin: 0;">
                Fizyobar ile iyi yaşam ve kalıcı dönüşüm yolculuğunuz.
            </p>
        </div>

        <div class="organic-flow-stage-container">
            <div class="organic-flow-canvas-wrap">
                <svg class="organic-flow-svg" id="organicFlowSvg" viewBox="0 0 1360 460" preserveAspectRatio="xMidYMid meet" aria-label="Fizyobar 3 Adımda Başla Yolculuğu">
                    <defs>
                        <!-- İnce Bordo Parıltı Gölgesi -->
                        <filter id="organicGlow" x="-20%" y="-20%" width="140%" height="140%">
                            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#4a1421" flood-opacity="0.22"/>
                        </filter>
                        <filter id="nodeHalo" x="-50%" y="-50%" width="200%" height="200%">
                            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#000000" flood-opacity="0.12"/>
                        </filter>
                    </defs>

                    <!-- 1. Arka Plan Kılavuz Çizgisi (Faint Reference Line) -->
                    <path class="organic-track-line"
                          d="M 80 130 C 115 160, 145 205, 180 230 C 220 250, 270 210, 275 150 C 280 95, 235 95, 235 155 C 235 220, 300 300, 420 320 C 510 335, 590 280, 640 250 C 690 220, 735 300, 735 365 C 735 425, 675 425, 675 355 C 675 270, 740 215, 830 200 C 895 190, 945 250, 985 265 C 1005 270, 1020 260, 1030 260"/>

                    <!-- 2. Sayfayı Kaydırdıkça Akışla Çizilen Canlı Bordo Çizgi -->
                    <path class="organic-animated-line" id="organicAnimatedLine"
                          d="M 80 130 C 115 160, 145 205, 180 230 C 220 250, 270 210, 275 150 C 280 95, 235 95, 235 155 C 235 220, 300 300, 420 320 C 510 335, 590 280, 640 250 C 690 220, 735 300, 735 365 C 735 425, 675 425, 675 355 C 675 270, 740 215, 830 200 C 895 190, 945 250, 985 265 C 1005 270, 1020 260, 1030 260"
                          filter="url(#organicGlow)"/>

                    <!-- 3. Başlangıç Dairesi (Konsantrik Çift Halka) -->
                    <g class="organic-node start-node is-active" id="organicNodeStart" data-threshold="0.05">
                        <circle cx="80" cy="130" r="16" fill="none" stroke="#d5d5d5" stroke-width="2"/>
                        <circle cx="80" cy="130" r="9" fill="#ffffff" stroke="#4a1421" stroke-width="2"/>
                        <circle cx="80" cy="130" r="4" fill="#4a1421"/>
                        <text x="80" y="96" text-anchor="middle" class="organic-node-kicker">BAŞLANGIÇ</text>
                    </g>

                    <!-- 4. Adım 01 (Kayıt & Beden Analizi) -->
                    <g class="organic-node" id="organicNode1" data-threshold="0.18">
                        <circle class="node-halo" cx="180" cy="230" r="14" fill="none" stroke="#4a1421" stroke-width="1.5"/>
                        <circle class="node-dot" cx="180" cy="230" r="6" fill="#ffffff" stroke="#4a1421" stroke-width="3" filter="url(#nodeHalo)"/>
                        <text x="180" y="276" text-anchor="middle" class="organic-node-num">01</text>
                        <text x="180" y="300" text-anchor="middle" class="organic-node-title">Kayıt &amp; Beden Analizi</text>
                        <text x="180" y="320" text-anchor="middle" class="organic-node-desc">Profil &amp; Postür Haritası</text>
                    </g>

                    <!-- 5. Adım 02 (Canlı Seanslar & BAR System) -->
                    <g class="organic-node is-highlight" id="organicNode2" data-threshold="0.46">
                        <circle class="node-halo" cx="420" cy="320" r="16" fill="none" stroke="#4a1421" stroke-width="1.5"/>
                        <circle class="node-dot" cx="420" cy="320" r="7" fill="#4a1421" stroke="#ffffff" stroke-width="2.5" filter="url(#nodeHalo)"/>
                        <text x="455" y="354" text-anchor="start" class="organic-node-num">02</text>
                        <text x="455" y="378" text-anchor="start" class="organic-node-title">Canlı Seanslar &amp; BAR System</text>
                        <text x="455" y="398" text-anchor="start" class="organic-node-desc">Diyafram, Vagus &amp; Mobilite Akışları</text>
                    </g>

                    <!-- 6. Adım 03 (Sürdürülebilir Longevity) -->
                    <g class="organic-node" id="organicNode3" data-threshold="0.72">
                        <circle class="node-halo" cx="830" cy="200" r="14" fill="none" stroke="#4a1421" stroke-width="1.5"/>
                        <circle class="node-dot" cx="830" cy="200" r="6" fill="#ffffff" stroke="#4a1421" stroke-width="3" filter="url(#nodeHalo)"/>
                        <text x="830" y="136" text-anchor="middle" class="organic-node-num">03</text>
                        <text x="830" y="160" text-anchor="middle" class="organic-node-title">Sürdürülebilir Longevity</text>
                        <text x="830" y="180" text-anchor="middle" class="organic-node-desc">Kalıcı İyi Yaşam &amp; Hücresel Canlılık</text>
                    </g>

                    <!-- 7. Bitiş / Hedef Dairesi -->
                    <g class="organic-node end-node" id="organicNodeEnd" data-threshold="0.88">
                        <circle cx="1030" cy="260" r="15" fill="none" stroke="#d5d5d5" stroke-width="2"/>
                        <circle cx="1030" cy="260" r="8" fill="#ffffff" stroke="#4a1421" stroke-width="2"/>
                        <circle cx="1030" cy="260" r="4" fill="#4a1421"/>
                        <text x="1030" y="232" text-anchor="middle" class="organic-node-kicker">DÖNÜŞÜM</text>
                    </g>

                    <!-- 8. Sağ Boşluktaki Programa Katıl Butonu (Rotanın Hedef Noktası) -->
                    <a href="<?= url('/programs') ?>" class="organic-svg-cta-link" id="flowCtaLink" target="_self" aria-label="Programa Katıl">
                        <g class="flow-cta-group" id="flowCtaGroup">
                            <line x1="1045" y1="260" x2="1078" y2="260" stroke="#4a1421" stroke-width="2" stroke-dasharray="4,3" class="cta-connector-line"/>
                            <polygon points="1077,256 1084,260 1077,264" fill="#4a1421" class="cta-connector-arrow"/>

                            <text class="flow-cta-kicker" x="1205" y="218" text-anchor="middle">HAZIR MISIN?</text>
                            <rect class="flow-cta-btn-bg" x="1085" y="234" width="240" height="52" rx="26" fill="#4a1421" filter="url(#organicGlow)"/>
                            <text class="flow-cta-btn-text" x="1195" y="266" text-anchor="middle">PROGRAMA KATIL</text>
                            <path class="flow-cta-btn-arrow" d="M 1272 260 L 1284 260 M 1279 255 L 1284 260 L 1279 265" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <text class="flow-cta-sub" x="1205" y="308" text-anchor="middle">Tüm Programları İncele &rarr;</text>
                        </g>
                    </a>
                </svg>

                <!-- Mobil Cihazlar İçin Alt Buton -->
                <div class="flow-mobile-cta text-center">
                    <a href="<?= url('/programs') ?>" class="btn-pill-solid">
                        PROGRAMA KATIL &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- 6. Bölüm III: ÖNE ÇIKAN DİJİTAL PROGRAM (2 KOLONLU MODERN SİNEMATİK KART) -->
<div class="camp-fullscreen-sticky-wrap" id="campStickyWrap">
    <section class="featured-offer-section" id="featured-program">
        <div class="container">
            
            <!-- Sinematik İki Kolonlu Kart (Sol: Video, Kavis & Butonlar / Sağ: Müfredat & Bilgiler) -->
            <div class="camp-cinema-card">
                
                <!-- SOL KOLON: Sinematik Video, İkonik Kavis ve Alt Fiyat & Dönüşüm Butonları -->
                <div class="camp-split-media">
                    <div class="camp-video-viewport" title="Videoyu Oynat / Durdur">
                        <video id="campHeroVideo" class="camp-video-element" autoplay loop muted playsinline preload="auto">
                            <source src="<?= asset('assets/videos/hero.webm') ?>" type="video/webm">
                            <source src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
                        </video>
                        <div class="camp-video-overlay"></div>
                    </div>

                    <!-- İçe Doğru Oyulmuş Kavisli Geçiş ve Ortadaki Play Butonu -->
                    <div class="camp-scoop-transition">
                        <div class="scoop-shoulder scoop-left"></div>
                        <div class="scoop-notch-wrap">
                            <svg class="scoop-notch-svg" viewBox="0 0 240 76" preserveAspectRatio="none">
                                <path d="M 0,0 L 20,0 C 45,0 72,12 80,30 C 80,52 98,70 120,70 C 142,70 160,52 160,30 C 168,12 195,0 220,0 L 240,0 L 240,76 L 0,76 Z" fill="#ffffff"/>
                            </svg>
                            <button type="button" class="camp-play-center-btn" id="campPlayBtn" aria-label="Kamp Videosunu Oynat/Durdur" title="Videoyu Duraklat">
                                <svg class="play-icon-svg" width="18" height="18" viewBox="0 0 24 24" fill="#111111">
                                    <rect x="6" y="4" width="4" height="16" rx="1"></rect>
                                    <rect x="14" y="4" width="4" height="16" rx="1"></rect>
                                </svg>
                            </button>
                        </div>
                        <div class="scoop-shoulder scoop-right"></div>
                    </div>

                    <!-- Video Altı: Fiyatlandırma & Aksiyon Paneli (Fiyat Solda, Katıl Butonu Sağda, Link Ortada) -->
                    <div class="camp-left-action-panel">
                        <div class="camp-price-cta-row">
                            <div class="camp-left-price-wrap">
                                <span class="price-kicker">TOPLAM YATIRIM</span>
                                <span class="price-amount" id="campPriceTypewriter" data-price="₺1.850">₺1.850</span>
                            </div>
                            <a href="<?= url('/checkout/1') ?>" class="btn-camp-cta-left">
                                500+ YOGİ ARASINA KATIL &rarr;
                            </a>
                        </div>
                        <a href="<?= url('/programs') ?>" class="link-all-packages-centered">
                            Tüm Paketleri ve Planları İncele &rarr;
                        </a>
                    </div>
                </div>

                <!-- SAĞ KOLON: Canlı Kontenjan Barı, Müfredat Başlığı, Rozetler, Açıklama ve 2 Ayrı Bilgi Kutusu -->
                <div class="camp-split-info">
                    <!-- Kart İçi Entegre Canlı Kontenjan Barı (Bordo Arka Plan) -->
                    <div class="camp-inner-quota-bar">
                        <div class="camp-inner-quota-header">
                            <span class="quota-count">
                                <span class="quota-pulse-dot"></span>
                                Son <strong>8</strong> Kişilik Yer Kaldı &bull; <strong>%87 Dolu</strong>
                            </span>
                        </div>
                        <div class="quota-bar-track">
                            <div class="quota-bar-fill" style="width: 87%;"></div>
                        </div>
                    </div>

                    <!-- Ana Başlık (Tek Satırda) -->
                    <h3 class="camp-main-heading">4 HAFTALIK ONLİNE DETOX &amp; YOGA KAMPI</h3>
                    
                    <!-- Paket İçeriği (Tik İkonlu Sade Düz Metin) -->
                    <div class="camp-specs-check-row">
                        <span class="camp-spec-check-item">
                            <svg class="spec-check-icon" width="14" height="14" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10.5L8 14.5L16 6.5" stroke="#4a1421" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span><strong>12</strong> Antrenman</span>
                        </span>
                        <span class="camp-spec-check-divider">•</span>
                        <span class="camp-spec-check-item">
                            <svg class="spec-check-icon" width="14" height="14" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10.5L8 14.5L16 6.5" stroke="#4a1421" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span><strong>28 Gün</strong> Program</span>
                        </span>
                        <span class="camp-spec-check-divider">•</span>
                        <span class="camp-spec-check-item">
                            <svg class="spec-check-icon" width="14" height="14" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10.5L8 14.5L16 6.5" stroke="#4a1421" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span><strong>%100</strong> Ekipmansız</span>
                        </span>
                    </div>

                    <!-- Açıklama Metni -->
                    <p class="camp-editorial-paragraph">
                        Fizyoterapist gözetiminde bedeni biyomekanik ve metabolik açıdan sıfırlayan, kanıta dayalı bütünsel hareket ve tokluk rutini.
                    </p>

                    <!-- Hediye Bonus & Üyelik Modeli (İki Ayrı Kutu: Bordo ve Gri) -->
                    <div class="camp-split-benefit-boxes">
                        <!-- Kutu 1: Hediye Bonus (Bordo Arka Plan) -->
                        <div class="camp-benefit-box box-bordo">
                            <div class="benefit-box-header">
                                <span class="benefit-box-pill pill-light">HEDİYE BONUS</span>
                            </div>
                            <p class="benefit-box-desc">
                                Normalde ₺750 değerindeki <strong>3'lü Meditasyon Paketi</strong> üyeliğinizle birlikte hesabınıza ücretsiz açılır.
                            </p>
                        </div>

                        <!-- Kutu 2: Üyelik Modeli (Gri Arka Plan) -->
                        <div class="camp-benefit-box box-gray">
                            <div class="benefit-box-header">
                                <span class="benefit-box-pill pill-dark">ÜYELİK MODELİ</span>
                            </div>
                            <p class="benefit-box-desc">
                                Aylık planda kendi paketiniz &amp; Kitchen; Yıllık All-Access planda tüm eğitimler sınırsız açılır.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- 8. Bölüm V: GERÇEK DÖNÜŞÜMLER (2 KATEGORİ: GÜÇ DÖNÜŞÜMLERİ / İNCELME DÖNÜŞÜMLERİ) -->
<section class="transformation-horizontal-section" id="donusum">
    <div class="container">
        <div class="section-title-wrap text-center">
            <span class="section-kicker">GERÇEK DENEYİMLER</span>
            <h2 class="section-heading-lg" style="margin-bottom: 0.6rem;">Dönüşüm Hikayeleri</h2>
            <p class="section-lead-muted" style="max-width: 680px; margin: 0 auto;">
                28 günde elde edilen anatomik güç ve estetik incelme sonuçları. Kartlara tıklayarak Öncesi/Sonrası arasında geçiş yapabilirsiniz.
            </p>

            <!-- 2 Kategori Filtresi (Sade Düz Metin & Dikey Çizgiler) -->
            <div class="trans-cat-filter-tabs">
                <button type="button" class="trans-tab-btn active" data-home-filter="all">TÜMÜ (6)</button>
                <span class="trans-tab-divider">|</span>
                <button type="button" class="trans-tab-btn" data-home-filter="power">GÜÇ DÖNÜŞÜMLERİ (3)</button>
                <span class="trans-tab-divider">|</span>
                <button type="button" class="trans-tab-btn" data-home-filter="slim">İNCELME DÖNÜŞÜMLERİ (3)</button>
            </div>
        </div>
    </div>

    <div class="transformation-slider-viewport" id="transSliderViewport">
        <div class="trans-edge-fog edge-left" aria-hidden="true"></div>
        <div class="trans-edge-fog edge-right" aria-hidden="true"></div>

        <div class="transformation-track" id="transTrack">
            <!-- Kart 1 (Güç) -->
            <div class="trans-card is-active" data-home-cat="power" data-index="0">
                <div class="card-inner">
                    <div class="card-face card-front">
                        <span class="card-cat-title">GÜÇ &amp; OMURGA</span>
                        <img src="<?= asset('assets/images/trans-1-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-before">ÖNCESİ</span>
                    </div>
                    <div class="card-face card-back">
                        <span class="card-cat-title">GÜÇ &amp; OMURGA</span>
                        <img src="<?= asset('assets/images/trans-1-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-after">SONRASI</span>
                    </div>
                </div>
            </div>

            <!-- Kart 2 (Güç) -->
            <div class="trans-card" data-home-cat="power" data-index="1">
                <div class="card-inner">
                    <div class="card-face card-front">
                        <span class="card-cat-title">CORE &amp; KALİSTHENİCS</span>
                        <img src="<?= asset('assets/images/trans-2-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-before">ÖNCESİ</span>
                    </div>
                    <div class="card-face card-back">
                        <span class="card-cat-title">CORE &amp; KALİSTHENİCS</span>
                        <img src="<?= asset('assets/images/trans-2-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-after">SONRASI</span>
                    </div>
                </div>
            </div>

            <!-- Kart 3 (Güç) -->
            <div class="trans-card" data-home-cat="power" data-index="2">
                <div class="card-inner">
                    <div class="card-face card-front">
                        <span class="card-cat-title">POSTÜR HİZALANMASI</span>
                        <img src="<?= asset('assets/images/trans-3-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-before">ÖNCESİ</span>
                    </div>
                    <div class="card-face card-back">
                        <span class="card-cat-title">POSTÜR HİZALANMASI</span>
                        <img src="<?= asset('assets/images/trans-3-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-after">SONRASI</span>
                    </div>
                </div>
            </div>

            <!-- Kart 4 (İncelme) -->
            <div class="trans-card" data-home-cat="slim" data-index="3">
                <div class="card-inner">
                    <div class="card-face card-front">
                        <span class="card-cat-title">İNCELME &amp; BEL</span>
                        <img src="<?= asset('assets/images/transformation-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-before">ÖNCESİ</span>
                    </div>
                    <div class="card-face card-back">
                        <span class="card-cat-title">İNCELME &amp; BEL</span>
                        <img src="<?= asset('assets/images/transformation-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-after">SONRASI</span>
                    </div>
                </div>
            </div>

            <!-- Kart 5 (İncelme) -->
            <div class="trans-card" data-home-cat="slim" data-index="4">
                <div class="card-inner">
                    <div class="card-face card-front">
                        <span class="card-cat-title">ÖDEM &amp; METABOLİK DETOKS</span>
                        <img src="<?= asset('assets/images/trans-2-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-before">ÖNCESİ</span>
                    </div>
                    <div class="card-face card-back">
                        <span class="card-cat-title">ÖDEM &amp; METABOLİK DETOKS</span>
                        <img src="<?= asset('assets/images/trans-2-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-after">SONRASI</span>
                    </div>
                </div>
            </div>

            <!-- Kart 6 (İncelme) -->
            <div class="trans-card" data-home-cat="slim" data-index="5">
                <div class="card-inner">
                    <div class="card-face card-front">
                        <span class="card-cat-title">SIKILAŞMA &amp; GLİSEMİK DENGE</span>
                        <img src="<?= asset('assets/images/trans-1-before.webp') ?>" alt="Öncesi" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-before">ÖNCESİ</span>
                    </div>
                    <div class="card-face card-back">
                        <span class="card-cat-title">SIKILAŞMA &amp; GLİSEMİK DENGE</span>
                        <img src="<?= asset('assets/images/trans-1-after.webp') ?>" alt="Sonrası" class="card-full-img" loading="lazy">
                        <span class="card-status-badge badge-after">SONRASI</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Yatay Slider Kontrolleri -->
    <div class="trans-controls-wrap">
        <button type="button" class="trans-nav-btn btn-prev" id="transPrevBtn" aria-label="Önceki Kart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
        <div class="trans-dots" id="transDots">
            <button type="button" class="trans-dot active" data-index="0" aria-label="1. Kart"></button>
            <button type="button" class="trans-dot" data-index="1" aria-label="2. Kart"></button>
            <button type="button" class="trans-dot" data-index="2" aria-label="3. Kart"></button>
            <button type="button" class="trans-dot" data-index="3" aria-label="4. Kart"></button>
            <button type="button" class="trans-dot" data-index="4" aria-label="5. Kart"></button>
            <button type="button" class="trans-dot" data-index="5" aria-label="6. Kart"></button>
        </div>
        <button type="button" class="trans-nav-btn btn-next" id="transNextBtn" aria-label="Sonraki Kart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
</section>

<!-- 9. Bölüm VI: KATILIMCI YORUMLARI (EDITORIAL TESTIMONIAL SLIDER) -->
<section class="editorial-testimonial-section">
    <div class="container">
        <div class="testimonial-editorial-box" id="testimonialBox">
            <div class="stars-row">★★★★★</div>
            
            <div class="testimonial-slider-viewport">
                <!-- Yorum 1 -->
                <div class="testimonial-slide active" data-index="0">
                    <blockquote class="testimonial-blockquote">
                        "Bu kampın bana en güzel hissettirdiği şey her sabah yeni bir challenge ile uyanmaktı. 
                        Gün içinde kendim için yaptığım küçük şeyler bile motivasyonumu artırdı. 
                        Hem yeni tarifler keşfettim hem de sağlıklı beslenmenin aslında zor olmadığını gördüm. 
                        En güzeli de hiçbir baskı hissetmeden sürecin içinde kalabilmekti..."
                    </blockquote>
                    <cite class="testimonial-author-cite">— Online Kamp Katılımcısı • 4 Haftalık Dönem</cite>
                </div>

                <!-- Yorum 2 -->
                <div class="testimonial-slide" data-index="1">
                    <blockquote class="testimonial-blockquote">
                        "Masa başı çalışmanın getirdiği kronik boyun ve sırt ağrılarım vardı. 
                        Fizyoterapist bakış açısıyla hazırlanan seanslar sayesinde bedenimdeki gerginliğin çözüldüğünü 
                        ve postürümün belirgin şekilde dikleştiğini hissettim. Artık güne çok daha enerjik başlıyorum."
                    </blockquote>
                    <cite class="testimonial-author-cite">— Ece K. • Online Studio &amp; Yoga Üyesi</cite>
                </div>

                <!-- Yorum 3 -->
                <div class="testimonial-slide" data-index="2">
                    <blockquote class="testimonial-blockquote">
                        "Beslenme rehberi ve glisemik denge yaklaşımı sayesinde aç kalmadan ve tatlı krizleri yaşamadan 
                        yeme alışkanlığımı dönüştürdüm. Betina Hanım'ın günlük birebir takibi motivasyonumu her an 
                        yüksek tuttu. Hayatıma kattığım en değerli alışkanlık oldu."
                    </blockquote>
                    <cite class="testimonial-author-cite">— Merve D. • Metabolik Detox Katılımcısı</cite>
                </div>

                <!-- Yorum 4 -->
                <div class="testimonial-slide" data-index="3">
                    <blockquote class="testimonial-blockquote">
                        "Yalnızca bir egzersiz programı değil; nefes, beden biyomekaniği ve zihinsel sakinliği 
                        bir arada sunan bütünsel bir yaşam disiplini. Her seans sonrasında hem zihnen hafifliyorum 
                        hem de omurgamın uzadığını hissediyorum."
                    </blockquote>
                    <cite class="testimonial-author-cite">— Selin T. • Longevity &amp; BAR System Katılımcısı</cite>
                </div>
            </div>

            <!-- Yumuşak Geçiş Butonları -->
            <div class="testimonial-soft-controls" id="testimonialDots" aria-label="Yorum Gezinimi">
                <button type="button" class="testimonial-soft-dot active" data-slide="0" aria-label="1. Yorum"></button>
                <button type="button" class="testimonial-soft-dot" data-slide="1" aria-label="2. Yorum"></button>
                <button type="button" class="testimonial-soft-dot" data-slide="2" aria-label="3. Yorum"></button>
                <button type="button" class="testimonial-soft-dot" data-slide="3" aria-label="4. Yorum"></button>
            </div>
        </div>
    </div>
</section>

<!-- 10. Bölüm VII: EĞİTMENLE TANIŞIN (EDİTORYAL DAĞINIK BORDO DAİRE & KOLAJ TASARIMI) -->
<section class="editorial-mentor-section" id="meet-your-guide" aria-label="Betina ile Tanışın">
    <div class="container mentor-scatter-container">
        
        <!-- Dağınık Kolaj Sahnesi (Bordo Daireler, Profil Fotoğrafı ve Yazı Kutusu) -->
        <div class="mentor-scatter-stage">

            <!-- 1. Bordo Daireler Grubu (Arka Plan ve Kolaj Katmanları) -->
            <div class="m-circle m-circle-bg-primary" aria-hidden="true"></div>
            <div class="m-circle m-circle-accent" aria-hidden="true"></div>
            <div class="m-circle m-circle-ring" aria-hidden="true"></div>
            <div class="m-circle m-circle-mini" aria-hidden="true"></div>

            <!-- 2. Sol Taraf: Profil Fotoğrafı ve Dağınık Görsel Kolajı -->
            <div class="mentor-scatter-visuals-col">
                <!-- Ana Profil Fotoğrafı Dairesi -->
                <div class="mentor-profile-circle-wrap">
                    <div class="mentor-profile-circle-frame">
                        <img src="<?= asset('assets/images/betina-user-photo1.jpg') ?>" 
                             alt="Betina Tansuğ - Uzman Fizyoterapist &amp; BAR System Kurucusu" 
                             class="mentor-profile-circle-img" 
                             loading="lazy">
                    </div>
                    
                    <!-- Daire Üzerinde Yüzen Rozet -->
                    <div class="mentor-floating-tag tag-role">
                        <span class="tag-dot"></span>
                        <span>KURUCU &amp; UZMAN FİZYOTERAPİST</span>
                    </div>
                    
                    <!-- Tecrübe Mührü Dairesi -->
                    <div class="mentor-experience-stamp">
                        <span class="stamp-num">17+</span>
                        <span class="stamp-label">Dönem Kamp</span>
                    </div>
                </div>

                <!-- İkincil Küçük Fotoğraf Dairesi (Dağınık Katman) -->
                <div class="mentor-secondary-circle-wrap">
                    <div class="mentor-secondary-circle-frame">
                        <img src="<?= asset('assets/images/betina-outdoor-stretch.jpg') ?>" 
                             alt="Betina Tansuğ Yoga &amp; Biyomekanik" 
                             class="mentor-secondary-circle-img" 
                             loading="lazy">
                    </div>
                </div>
            </div>

            <!-- 3. Sağ Taraf: Ana Yazı Alanı Kutusu (Bordo Dairelerin Üzerine Dağınık Örtüşen Editoryal Kart) -->
            <div class="mentor-scatter-text-box">
                <div class="mentor-box-kicker">
                    <span class="box-kicker-dot"></span>
                    <span>EĞİTMENİNLE TANIŞ &bull; BETİNA TANSUĞ</span>
                </div>

                <h3 class="mentor-box-quote">
                    "Hareketi bir heves değil, beden ve zihin arasında kurulan <em>en kalıcı yaşam disiplini</em> olarak görüyorum."
                </h3>

                <!-- Butonlar -->
                <div class="mentor-box-actions">
                    <a href="<?= url('/betina-tansug') ?>" class="btn-mentor-cta">
                        <span>BETİNA İLE TANIŞ</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?= url('/metod') ?>" class="btn-mentor-link">
                        BAR System Metodolojisi &rarr;
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Scriptler: Kamp Videosu, Before/After Slider ve Kategori Filtresi, Testimonial Loop -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Kamp Videosu Oynatıcı
    const video = document.getElementById('campHeroVideo');
    const playBtn = document.getElementById('campPlayBtn');
    const viewport = document.querySelector('.camp-video-viewport');
    
    function setBtnIcon(isPlaying) {
        if (!playBtn) return;
        if (isPlaying) {
            playBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="#111111"><rect x="6" y="4" width="4" height="16" rx="1"></rect><rect x="14" y="4" width="4" height="16" rx="1"></rect></svg>';
            playBtn.setAttribute('title', 'Videoyu Duraklat');
        } else {
            playBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="#111111" style="margin-left: 2px;"><polygon points="6 4 20 12 6 20 6 4"></polygon></svg>';
            playBtn.setAttribute('title', 'Videoyu Oynat');
        }
    }

    if (video) {
        video.muted = true;
        video.defaultMuted = true;
        video.playsInline = true;

        const safePlay = function() {
            video.muted = true;
            const p = video.play();
            if (p !== undefined) {
                p.then(function() {
                    setBtnIcon(true);
                }).catch(function() {
                    setBtnIcon(false);
                });
            }
        };

        try { video.load(); } catch(e) {}
        safePlay();

        function togglePlayState(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            if (video.paused) {
                video.muted = true;
                video.play().then(function() {
                    setBtnIcon(true);
                }).catch(function() {
                    setBtnIcon(false);
                });
            } else {
                video.pause();
                setBtnIcon(false);
            }
        }

        if (playBtn) playBtn.addEventListener('click', togglePlayState);
        if (viewport) {
            viewport.style.cursor = 'pointer';
            viewport.addEventListener('click', togglePlayState);
        }
    }

    // 2. Before / After Kategori Filtresi & Slider Gezinimi (Döngüyü bozmadan akıcı yönlendirme)
    const homeFilterTabs = document.querySelectorAll('[data-home-filter]');
    const transDots = document.querySelectorAll('#transDots .trans-dot');

    homeFilterTabs.forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            homeFilterTabs.forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            const targetFilter = this.getAttribute('data-home-filter');

            let targetDot = 0;
            if (targetFilter === 'slim') {
                targetDot = 3;
            } else if (targetFilter === 'power') {
                targetDot = 0;
            }

            if (transDots && transDots[targetDot]) {
                transDots[targetDot].click();
            }
        });
    });

    // 3. Kamp Alanı Tam Ekran Odaklanma & Header Gizleme + Daktilo Fiyat Efekti
    (function() {
        const campWrap = document.getElementById('campStickyWrap') || document.getElementById('featured-program');
        const campSec = document.getElementById('featured-program');
        const header = document.querySelector('.site-header');
        const priceEl = document.getElementById('campPriceTypewriter');
        if (!campSec) return;

        let hasTyped = false;
        const targetPrice = '₺1.850';

        function typePrice() {
            if (!priceEl) return;
            priceEl.innerHTML = '';
            priceEl.classList.remove('price-blinking');
            let i = 0;
            const cursor = document.createElement('span');
            cursor.className = 'typewriter-cursor';
            cursor.textContent = '|';
            priceEl.appendChild(cursor);

            const timer = setInterval(function() {
                if (i < targetPrice.length) {
                    const char = targetPrice.charAt(i);
                    cursor.insertAdjacentText('beforebegin', char);
                    i++;
                } else {
                    clearInterval(timer);
                    setTimeout(function() {
                        priceEl.classList.add('price-blinking');
                    }, 350);
                }
            }, 85);
        }

        function checkFocus() {
            const isDesktop = window.innerWidth >= 992;
            const rectWrap = (campWrap || campSec).getBoundingClientRect();
            const rectSec = campSec.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;

            if (isDesktop && header) {
                // Sticky wrap içindeyken (üst kenar 0'a ulaştığında ve wrap bitene kadar) header gizli kalsın
                const inFocus = (rectWrap.top <= 80 && rectWrap.bottom >= windowHeight * 0.35);
                if (inFocus) {
                    header.classList.add('header-hidden-focus');
                } else {
                    header.classList.remove('header-hidden-focus');
                }
            } else if (header) {
                header.classList.remove('header-hidden-focus');
            }

            // Daktilo efekti tetikleme
            const inView = (rectSec.top <= windowHeight * 0.85 && rectSec.bottom >= windowHeight * 0.15);
            if (inView && !hasTyped) {
                hasTyped = true;
                typePrice();
            }
        }

        window.addEventListener('scroll', checkFocus, { passive: true });
        window.addEventListener('resize', checkFocus, { passive: true });
        checkFocus();
    })();
});

// Testimonial Otomatik Döngü
(function() {
    function initTestimonialSlider() {
        const box = document.getElementById('testimonialBox');
        if (!box) return;

        const slides = Array.from(box.querySelectorAll('.testimonial-slide'));
        const dots = Array.from(box.querySelectorAll('.testimonial-soft-dot'));
        if (slides.length <= 1) return;

        let currentIndex = 0;
        let timer = null;
        const INTERVAL_MS = 3000;

        function showSlide(index) {
            currentIndex = ((index % slides.length) + slides.length) % slides.length;

            for (let i = 0; i < slides.length; i++) {
                if (i === currentIndex) {
                    slides[i].classList.add('active');
                } else {
                    slides[i].classList.remove('active');
                }
            }

            for (let i = 0; i < dots.length; i++) {
                if (i === currentIndex) {
                    dots[i].classList.add('active');
                } else {
                    dots[i].classList.remove('active');
                }
            }
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function startAutoLoop() {
            if (timer) clearInterval(timer);
            timer = setInterval(nextSlide, INTERVAL_MS);
        }

        dots.forEach((dot, i) => {
            dot.addEventListener('click', function(e) {
                e.preventDefault();
                showSlide(i);
                startAutoLoop();
            });
        });

        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) startAutoLoop();
        });

        showSlide(0);
        startAutoLoop();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTestimonialSlider);
    } else {
        initTestimonialSlider();
    }
})();
</script>
