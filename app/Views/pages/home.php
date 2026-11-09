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
                <a href="#featured-program" class="btn-pill-solid">
                    PROGRAMLARI KEŞFET
                </a>
                <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-pill-outline">
                    WHATSAPP DANIŞMA
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. Markalar & Topluluklar Ticker (Bannerın Hemen Altında) -->
<section class="partners-section">
    <div class="container">
        <div class="partners-sublabel">BİRLİKTE DENEYİM YARATTIĞIMIZ MARKALAR & TOPLULUKLAR</div>
        <div class="partners-flex-row">
            <span class="partner-name">LOURE COMMUNITY</span>
            <span class="partner-slash">/</span>
            <span class="partner-name">QGYM</span>
            <span class="partner-slash">/</span>
            <span class="partner-name">ADANA KÜREK KULÜBÜ</span>
            <span class="partner-slash">/</span>
            <span class="partner-name">BOSNALI HOTEL</span>
            <span class="partner-slash">/</span>
            <span class="partner-name">BOBO</span>
            <span class="partner-slash">/</span>
            <span class="partner-name">ABABE</span>
        </div>
    </div>
</section>

<!-- 3. Bölüm I: YAKLAŞIMIMIZ (ABOUT - 2 Kolonlu Mimari Grid & Kenarlardan Çizgisel Organik Akış) -->
<section class="editorial-about-section" id="metod">
    <!-- Sol Kenar Çizgisel Organik Akış (3 Adımda Başla Tarzı) -->
    <div class="about-line-art-wrap about-lines-left" aria-hidden="true">
        <svg class="about-svg-lines" viewBox="0 0 240 360" fill="none" preserveAspectRatio="none">
            <defs>
                <linearGradient id="aboutGradLeft" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#C6B39A"/>
                    <stop offset="55%" stop-color="#8D3A3C"/>
                    <stop offset="100%" stop-color="#3B1319"/>
                </linearGradient>
            </defs>
            <!-- Silik Kılavuz Çizgisi -->
            <path class="about-track-path" d="M -10 30 C 90 60, 180 110, 150 190 C 120 270, 30 290, 80 370" stroke="#ede7df" stroke-width="2" stroke-linecap="round"/>
            <!-- Scroll ile Çizilen Canlı Çizgi -->
            <path class="about-draw-path" id="aboutDrawPathLeft" d="M -10 30 C 90 60, 180 110, 150 190 C 120 270, 30 290, 80 370" stroke="url(#aboutGradLeft)" stroke-width="2.5" stroke-linecap="round"/>
            <!-- Estetik Node / Halka -->
            <circle cx="150" cy="190" r="11" fill="#ffffff" stroke="#C6B39A" stroke-width="1.5"/>
            <circle cx="150" cy="190" r="4.5" fill="#8D3A3C"/>
        </svg>
    </div>

    <!-- Sağ Kenar Çizgisel Organik Akış -->
    <div class="about-line-art-wrap about-lines-right" aria-hidden="true">
        <svg class="about-svg-lines" viewBox="0 0 240 360" fill="none" preserveAspectRatio="none">
            <defs>
                <linearGradient id="aboutGradRight" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#8D3A3C"/>
                    <stop offset="50%" stop-color="#C6B39A"/>
                    <stop offset="100%" stop-color="#7B694E"/>
                </linearGradient>
            </defs>
            <!-- Silik Kılavuz Çizgisi -->
            <path class="about-track-path" d="M 250 40 C 160 80, 70 140, 100 220 C 125 285, 210 310, 170 370" stroke="#ede7df" stroke-width="2" stroke-linecap="round"/>
            <!-- Scroll ile Çizilen Canlı Çizgi -->
            <path class="about-draw-path" id="aboutDrawPathRight" d="M 250 40 C 160 80, 70 140, 100 220 C 125 285, 210 310, 170 370" stroke="url(#aboutGradRight)" stroke-width="2.5" stroke-linecap="round"/>
            <!-- Estetik Node / Halka -->
            <circle cx="100" cy="220" r="11" fill="#ffffff" stroke="#8D3A3C" stroke-width="1.5"/>
            <circle cx="100" cy="220" r="4.5" fill="#C6B39A"/>
        </svg>
    </div>

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

<!-- 4. BAR System 3 Adımlı Kayıt & Katılım Süreci (Sticky Pinned Organik Akış & Scroll Çizim Animasyonu) -->
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
                            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#391214" flood-opacity="0.22"/>
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
                        <circle cx="80" cy="130" r="9" fill="#ffffff" stroke="#391214" stroke-width="2"/>
                        <circle cx="80" cy="130" r="4" fill="#391214"/>
                        <text x="80" y="96" text-anchor="middle" class="organic-node-kicker">BAŞLANGIÇ</text>
                    </g>

                    <!-- 4. Adım 01 (Kayıt & Beden Analizi) -->
                    <g class="organic-node" id="organicNode1" data-threshold="0.18">
                        <circle class="node-halo" cx="180" cy="230" r="14" fill="none" stroke="#391214" stroke-width="1.5"/>
                        <circle class="node-dot" cx="180" cy="230" r="6" fill="#ffffff" stroke="#391214" stroke-width="3" filter="url(#nodeHalo)"/>
                        <text x="180" y="276" text-anchor="middle" class="organic-node-num">01</text>
                        <text x="180" y="300" text-anchor="middle" class="organic-node-title">Kayıt &amp; Beden Analizi</text>
                        <text x="180" y="320" text-anchor="middle" class="organic-node-desc">Profil &amp; Postür Haritası</text>
                    </g>

                    <!-- 5. Adım 02 (Canlı Seanslar & BAR System) -->
                    <g class="organic-node is-highlight" id="organicNode2" data-threshold="0.46">
                        <circle class="node-halo" cx="420" cy="320" r="16" fill="none" stroke="#391214" stroke-width="1.5"/>
                        <circle class="node-dot" cx="420" cy="320" r="7" fill="#391214" stroke="#ffffff" stroke-width="2.5" filter="url(#nodeHalo)"/>
                        <text x="455" y="354" text-anchor="start" class="organic-node-num">02</text>
                        <text x="455" y="378" text-anchor="start" class="organic-node-title">Canlı Seanslar &amp; BAR System</text>
                        <text x="455" y="398" text-anchor="start" class="organic-node-desc">Diyafram, Vagus &amp; Mobilite Akışları</text>
                    </g>

                    <!-- 6. Adım 03 (Sürdürülebilir Longevity) -->
                    <g class="organic-node" id="organicNode3" data-threshold="0.72">
                        <circle class="node-halo" cx="830" cy="200" r="14" fill="none" stroke="#391214" stroke-width="1.5"/>
                        <circle class="node-dot" cx="830" cy="200" r="6" fill="#ffffff" stroke="#391214" stroke-width="3" filter="url(#nodeHalo)"/>
                        <text x="830" y="136" text-anchor="middle" class="organic-node-num">03</text>
                        <text x="830" y="160" text-anchor="middle" class="organic-node-title">Sürdürülebilir Longevity</text>
                        <text x="830" y="180" text-anchor="middle" class="organic-node-desc">Kalıcı İyi Yaşam &amp; Hücresel Canlılık</text>
                    </g>

                    <!-- 7. Bitiş / Hedef Dairesi -->
                    <g class="organic-node end-node" id="organicNodeEnd" data-threshold="0.88">
                        <circle cx="1030" cy="260" r="15" fill="none" stroke="#d5d5d5" stroke-width="2"/>
                        <circle cx="1030" cy="260" r="8" fill="#ffffff" stroke="#391214" stroke-width="2"/>
                        <circle cx="1030" cy="260" r="4" fill="#391214"/>
                        <text x="1030" y="232" text-anchor="middle" class="organic-node-kicker">DÖNÜŞÜM</text>
                    </g>

                    <!-- 8. Sağ Boşluktaki Programa Katıl Butonu (Rotanın Hedef Noktası) -->
                    <a href="<?= url('/programs') ?>" class="organic-svg-cta-link" id="flowCtaLink" target="_self" aria-label="Programa Katıl">
                        <g class="flow-cta-group" id="flowCtaGroup">
                            <!-- Bağlantı Yönlendirme Çizgisi -->
                            <line x1="1045" y1="260" x2="1078" y2="260" stroke="#391214" stroke-width="2" stroke-dasharray="4,3" class="cta-connector-line"/>
                            <polygon points="1077,256 1084,260 1077,264" fill="#391214" class="cta-connector-arrow"/>

                            <!-- Üst Etiket -->
                            <text class="flow-cta-kicker" x="1205" y="218" text-anchor="middle">HAZIR MISIN?</text>

                            <!-- Buton Gövdesi (Pill Bordo Buton) -->
                            <rect class="flow-cta-btn-bg" x="1085" y="234" width="240" height="52" rx="26" fill="#391214" filter="url(#organicGlow)"/>

                            <!-- Buton İçi Yazı ve İkon -->
                            <text class="flow-cta-btn-text" x="1195" y="266" text-anchor="middle">PROGRAMA KATIL</text>
                            <path class="flow-cta-btn-arrow" d="M 1272 260 L 1284 260 M 1279 255 L 1284 260 L 1279 265" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>

                            <!-- Alt Güven Rozeti -->
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
                </svg>
            </div>
        </div>
    </section>
</div>

<!-- 5. Bölüm III: ÖNE ÇIKAN DİJİTAL PROGRAM (SİNEMATİK KAMP VİDEOSU & KOMPAKT DİKDÖRTGEN MİMARİ) -->
<section class="featured-offer-section" id="featured-program">
    <div class="container">
        <!-- Sinematik Dikdörtgen Kart (Kompakt, Sayfaya Tam Oturan Yapı) -->
        <div class="camp-cinema-card">
            <!-- A. Üst Video Alanı (Genişletilmiş Sinematik Kamp Akışı) -->
            <div class="camp-video-viewport" title="Videoyu Oynat / Durdur">
                <video id="campHeroVideo" class="camp-video-element" autoplay loop muted playsinline preload="auto">
                    <source src="<?= asset('assets/videos/hero.webm') ?>" type="video/webm">
                    <source src="<?= asset('assets/videos/hero.mp4') ?>" type="video/mp4">
                </video>
                <div class="camp-video-overlay"></div>
            </div>

            <!-- B. İçe Doğru Oyulmuş Kavisli Geçiş ve Ortadaki Bağımsız Yuvarlak Buton -->
            <div class="camp-scoop-transition">
                <div class="scoop-shoulder scoop-left"></div>
                <div class="scoop-notch-wrap">
                    <svg class="scoop-notch-svg" viewBox="0 0 240 76" preserveAspectRatio="none">
                        <path d="M 0,0 L 20,0 C 45,0 72,12 80,30 C 80,52 98,70 120,70 C 142,70 160,52 160,30 C 168,12 195,0 220,0 L 240,0 L 240,76 L 0,76 Z" fill="#ffffff"/>
                    </svg>
                    <!-- Ortadaki Yuvarlak Play Butonu (Aşağıya Değmeyen, Temiz Havada Duran Tasarım) -->
                    <button type="button" class="camp-play-center-btn" id="campPlayBtn" aria-label="Kamp Videosunu Oynat/Durdur" title="Videoyu Duraklat">
                        <svg class="play-icon-svg" width="18" height="18" viewBox="0 0 24 24" fill="#111111">
                            <rect x="6" y="4" width="4" height="16" rx="1"></rect>
                            <rect x="14" y="4" width="4" height="16" rx="1"></rect>
                        </svg>
                    </button>
                </div>
                <div class="scoop-shoulder scoop-right"></div>
            </div>

            <!-- C. Alt Beyaz İçerik Alanı (Sadeleştirilmiş, Kompakt İki Kolon) -->
            <div class="camp-bottom-content">
                <div class="camp-content-grid">
                    <!-- Sol Kolon: Başlık, Madde İmleri ve Hızlı Aksiyon -->
                    <div class="camp-col-left">
                        <span class="camp-kicker-tag">MÜFREDAT &amp; KAPSAM</span>
                        <h3 class="camp-main-heading">PROGRAMDA SENİ NELER BEKLİYOR?</h3>
                        
                        <!-- Sadeleştirilmiş Tireli Liste -->
                        <ul class="camp-dashed-list">
                            <li><span class="dash">—</span> Haftada 3 Canlı Yoga Seansı &amp; Postür Düzeltmeleri</li>
                            <li><span class="dash">—</span> Fizyoterapist ile Günlük Birebir WhatsApp Takibi</li>
                            <li><span class="dash">—</span> Rafine Şekersiz Glisemik Beslenme &amp; GLP-1 Yönetimi</li>
                        </ul>

                        <div class="camp-action-row">
                            <div class="camp-price-chip">
                                <span class="chip-label">Toplam Yatırım</span>
                                <span class="chip-val">₺4.500</span>
                            </div>
                            <a href="<?= url('/checkout/1') ?>" class="btn-camp-primary">
                                KAMPA KATIL &rarr;
                            </a>
                            <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%204%20Haftal%C4%B1k%20Online%20Detox%20kamp%C4%B1%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." 
                               target="_blank" rel="noopener noreferrer" 
                               class="btn-camp-wa-link">
                                WhatsApp Danış &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Sağ Kolon: Kısa Açıklama ve 2 Kompakt Önizleme Kartı -->
                    <div class="camp-col-right">
                        <p class="camp-editorial-paragraph">
                            Fizyoterapist gözetiminde bedeni biyomekanik ve metabolik açıdan sıfırlayan kanıta dayalı bütünsel yaşam rutini.
                        </p>

                        <div class="camp-preview-cards-row">
                            <!-- Kart 1: Canlı Seanslar -->
                            <div class="camp-mini-feature-card">
                                <div class="mini-card-top">
                                    <span class="mini-card-index">01 / SEANSLAR</span>
                                    <h4 class="mini-card-title">16+ Canlı Seans</h4>
                                    <p class="mini-card-desc">Omurga mobilizasyonu ve postür akışları.</p>
                                </div>
                                <div class="mini-card-bottom">
                                    <span class="mini-card-badge">CANLI YOGA</span>
                                </div>
                            </div>

                            <!-- Kart 2: Birebir Takip -->
                            <div class="camp-mini-feature-card">
                                <div class="mini-card-top">
                                    <span class="mini-card-index">02 / TAKİP</span>
                                    <h4 class="mini-card-title">Birebir Takip</h4>
                                    <p class="mini-card-desc">Günlük WhatsApp kontrolü ve tokluk yönetimi.</p>
                                </div>
                                <div class="mini-card-bottom">
                                    <span class="mini-card-badge">DETOX &amp; VAGUS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
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

        // Sayfa yüklenince hemen yükle ve oynat
        try { video.load(); } catch(e) {}
        safePlay();

        // Kart ekrana girdiğinde oynatmayı tetikle
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting && video.paused) {
                        safePlay();
                    }
                });
            }, { threshold: 0.15 });
            io.observe(video);
        }

        // Kullanıcı sayfayla ilk etkileşime girdiğinde garantile
        const triggerOnInteract = function() {
            if (video.paused) {
                safePlay();
            }
        };
        document.addEventListener('scroll', triggerOnInteract, { once: true, passive: true });
        document.addEventListener('click', triggerOnInteract, { once: true });
        document.addEventListener('touchstart', triggerOnInteract, { once: true });

        // Video ve buton tıklamaları
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

        if (playBtn) {
            playBtn.addEventListener('click', togglePlayState);
        }
        if (viewport) {
            viewport.style.cursor = 'pointer';
            viewport.addEventListener('click', togglePlayState);
        }

        video.addEventListener('play', function() { setBtnIcon(true); });
        video.addEventListener('pause', function() { setBtnIcon(false); });
        video.addEventListener('playing', function() { setBtnIcon(true); });
    }
});
</script>

<!-- 6. Bölüm V: GERÇEK DÖNÜŞÜMLER (YATAY KAYDIRMALI & SİSLİ BEFORE / AFTER SLIDER) -->
<section class="transformation-horizontal-section" id="donusum">
    <div class="container">
        <div class="section-title-wrap text-center">
            <span class="section-kicker">GERÇEK DENEYİMLER</span>
            <h2 class="section-heading-lg">Dönüşüm Hikayeleri</h2>
            <p class="section-lead-muted">Kartları kaydırarak danışanlarımızın dönüşümünü keşfedin, öncesi ve sonrasını görmek için karta tıklayın.</p>
        </div>
    </div>

    <div class="transformation-slider-viewport" id="transSliderViewport">
        <!-- Kenar Sis Degrade Efektleri (Editorial Fog Overlays) -->
        <div class="trans-edge-fog edge-left" aria-hidden="true"></div>
        <div class="trans-edge-fog edge-right" aria-hidden="true"></div>

        <div class="transformation-track" id="transTrack">
            <!-- Kart 1 -->
            <div class="trans-card is-active" data-index="0">
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

            <!-- Kart 2 -->
            <div class="trans-card" data-index="1">
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

            <!-- Kart 3 -->
            <div class="trans-card" data-index="2">
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

            <!-- Kart 4 -->
            <div class="trans-card" data-index="3">
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

            <!-- Kart 5 -->
            <div class="trans-card" data-index="4">
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

            <!-- Kart 6 -->
            <div class="trans-card" data-index="5">
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
        </div>
    </div>

    <!-- Yatay Slider Kontrolleri (Oklar ve Dot Göstergeleri) -->
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

<!-- 8. Bölüm VI: KATILIMCI YORUMLARI (EDITORIAL TESTIMONIAL SLIDER) -->
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

            <!-- Yumuşak Geçiş Butonları (Soft Dots) -->
            <div class="testimonial-soft-controls" id="testimonialDots" aria-label="Yorum Gezinimi">
                <button type="button" class="testimonial-soft-dot active" data-slide="0" aria-label="1. Yorum"></button>
                <button type="button" class="testimonial-soft-dot" data-slide="1" aria-label="2. Yorum"></button>
                <button type="button" class="testimonial-soft-dot" data-slide="2" aria-label="3. Yorum"></button>
                <button type="button" class="testimonial-soft-dot" data-slide="3" aria-label="4. Yorum"></button>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    function initTestimonialSlider() {
        const box = document.getElementById('testimonialBox');
        if (!box) return;

        const slides = Array.from(box.querySelectorAll('.testimonial-slide'));
        const dots = Array.from(box.querySelectorAll('.testimonial-soft-dot'));
        if (slides.length <= 1) return;

        let currentIndex = 0;
        let timer = null;
        const INTERVAL_MS = 2500; // Sürekli ve akıcı değişim için 2.5 saniye

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

        // Dot tıklamaları
        dots.forEach((dot, i) => {
            dot.addEventListener('click', function(e) {
                e.preventDefault();
                showSlide(i);
                startAutoLoop();
            });
        });

        // Pencere / sekme aktif olduğunda daima canlı tut
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                startAutoLoop();
            }
        });

        // Kesintisiz döngüyü hemen başlat
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
