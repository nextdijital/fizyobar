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

<!-- 3. Bölüm I: YAKLAŞIMIMIZ (ABOUT - 2 Kolonlu Mimari Grid) -->
<section class="editorial-about-section" id="metod">
    <div class="container">
        <div class="editorial-about-grid">
            <!-- Sol Kolon: Sadece Başlık -->
            <div class="about-title-col">
                <h2 class="about-headline">Klasik Derslerin Ötesinde:</h2>
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

<!-- 4. BAR System 3 Adımlı Kayıt & Katılım Süreci (Scroll Akışı & Dönüşüm Mimarisi) -->
<section class="methodology-flow-section" id="metodoloji-akisi">
    <div class="container flow-header-container">
        <div class="section-title-wrap text-center">
            <span class="section-kicker">KAYIT & KATILIM SÜRECİ</span>
            <h2 class="section-heading-lg">3 Adımda Başla</h2>
            <p class="section-lead-muted">
                Fizyobar ile iyi yaşam ve kalıcı dönüşüm yolculuğunuza adım atın.
            </p>
        </div>
    </div>

    <div class="container flow-diagram-container">
        <!-- Vektörel Mimari Diyagram (Yükseltilmiş Daireler, Bordo Kanatlar & Saran Yaylar) -->
        <div class="flow-vector-stage" id="flowVectorStage">
            <svg class="flow-interactive-svg" viewBox="0 0 1000 330" preserveAspectRatio="xMidYMid meet" aria-label="Fizyobar Metodoloji ve Kayıt Akışı">
                <defs>
                    <!-- Referans Tasarım İnce Açılı Ok Ucu -->
                    <marker id="flowArrowRefTop" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                        <path d="M 1 1 L 8 5 L 1 9" fill="none" stroke="#391214" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </marker>

                    <!-- Üst Kanat İpeksi Bordo Gradyan -->
                    <linearGradient id="flowWingGradTop" x1="330" y1="25" x2="330" y2="160" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#391214" stop-opacity="0.26"/>
                        <stop offset="50%" stop-color="#391214" stop-opacity="0.10"/>
                        <stop offset="100%" stop-color="#391214" stop-opacity="0.0"/>
                    </linearGradient>

                    <!-- Alt Kanat İpeksi Bordo Gradyan -->
                    <linearGradient id="flowWingGradBottom" x1="670" y1="295" x2="670" y2="160" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#391214" stop-opacity="0.26"/>
                        <stop offset="50%" stop-color="#391214" stop-opacity="0.10"/>
                        <stop offset="100%" stop-color="#391214" stop-opacity="0.0"/>
                    </linearGradient>

                    <!-- Daire Gölgeleri -->
                    <filter id="flowBordoCircleShadow" x="-30%" y="-30%" width="160%" height="160%">
                        <feDropShadow dx="0" dy="8" stdDeviation="12" flood-color="#391214" flood-opacity="0.28"/>
                    </filter>
                    <filter id="flowOutlineCircleShadow" x="-30%" y="-30%" width="160%" height="160%">
                        <feDropShadow dx="0" dy="5" stdDeviation="8" flood-color="#000000" flood-opacity="0.05"/>
                    </filter>
                </defs>

                <!-- 1. Bordo Gölgeli Kanatlar (Silikli Shaded Wings) -->
                <path class="flow-svg-wing flow-wing-top" d="M 120 200 C 95 160, 95 115, 122 88 C 150 60, 230 25, 330 25 C 430 25, 490 60, 522 96 A 68 68 0 0 0 432 160 L 218 160 A 58 58 0 0 1 120 200 Z" fill="url(#flowWingGradTop)"/>
                <path class="flow-svg-wing flow-wing-bottom" d="M 455 210 C 475 234, 525 234, 550 215 C 585 265, 625 295, 670 295 C 750 295, 810 260, 862 214 A 58 58 0 0 1 782 160 L 568 160 A 68 68 0 0 1 455 210 Z" fill="url(#flowWingGradBottom)"/>

                <!-- 2. Daireleri Saran Üst ve Alt Yaylar (Wrapping Arcs with Arrows) -->
                <path class="flow-svg-arc flow-arc-top" d="M 120 200 C 95 160, 95 115, 122 88 C 150 60, 230 25, 330 25 C 430 25, 490 60, 522 96" fill="none" stroke="#391214" stroke-width="2.2" marker-end="url(#flowArrowRefTop)"/>
                <path class="flow-svg-arc flow-arc-bottom" d="M 455 210 C 475 234, 525 234, 550 215 C 585 265, 625 295, 670 295 C 750 295, 810 260, 862 214" fill="none" stroke="#391214" stroke-width="2.2" marker-end="url(#flowArrowRefTop)"/>

                <!-- 3. Yatay Merkez Ekseni (Yükseltilmiş Y = 160) -->
                <line x1="40" y1="160" x2="960" y2="160" stroke="#e8e8e8" stroke-width="2"/>
                <line id="flowSvgProgressLine" x1="40" y1="160" x2="40" y2="160" stroke="#391214" stroke-width="2.5" stroke-linecap="round"/>

                <!-- 4. Referans Metin Etiketleri -->
                <!-- Üst Zirve Başlığı -->
                <text x="330" y="16" text-anchor="middle" class="flow-svg-apex">KAYIT &amp; ANALİZ</text>
                <!-- Daire 1 ve Daire 2 Arası -->
                <text x="330" y="132" text-anchor="middle" class="flow-svg-mid-top">Storytelling</text>
                <text x="330" y="190" text-anchor="middle" class="flow-svg-mid-bottom">Beden Haritası</text>

                <!-- Daire 2 ve Daire 3 Arası -->
                <text x="670" y="132" text-anchor="middle" class="flow-svg-mid-top">Diyafram &amp; Vagus</text>
                <text x="670" y="190" text-anchor="middle" class="flow-svg-mid-bottom">Hücresel Longevity</text>
                <!-- Alt Çukur Başlığı -->
                <text x="670" y="322" text-anchor="middle" class="flow-svg-apex">DÖNÜŞÜM &amp; DEĞER</text>

                <!-- 5. Yükseltilmiş İstasyon Daireleri -->
                <!-- Daire 1: Hesap & Profil -->
                <g class="flow-svg-node" id="svgNode1" data-step="1">
                    <circle cx="160" cy="160" r="58" fill="#ffffff" stroke="#1a1a1a" stroke-width="2" filter="url(#flowOutlineCircleShadow)" class="flow-node-c1"/>
                    <text x="160" y="142" text-anchor="middle" class="flow-svg-num">01</text>
                    <text x="160" y="162" text-anchor="middle" class="flow-svg-title">Hesap &amp; Profil</text>
                    <text x="160" y="178" text-anchor="middle" class="flow-svg-sub">Kayıt Adımı</text>
                </g>

                <!-- Daire 2: Canlı Seans & Eğitim (Merkez Bordo Daire) -->
                <g class="flow-svg-node is-center-bordo" id="svgNode2" data-step="2">
                    <circle cx="500" cy="160" r="68" fill="#391214" stroke="#ffffff" stroke-width="3" filter="url(#flowBordoCircleShadow)" class="flow-node-c2"/>
                    <text x="500" y="128" text-anchor="middle" class="flow-svg-bordo-num">02</text>
                    <text x="500" y="146" text-anchor="middle" class="flow-svg-bordo-title">Canlı Seans &amp; Eğitim</text>
                    <line x1="460" y1="156" x2="540" y2="156" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
                    <text x="500" y="174" text-anchor="middle" class="flow-svg-bordo-sub">BAR SYSTEM</text>
                </g>

                <!-- Daire 3: Dönüşüm & Rutin -->
                <g class="flow-svg-node" id="svgNode3" data-step="3">
                    <circle cx="840" cy="160" r="58" fill="#ffffff" stroke="#1a1a1a" stroke-width="2" filter="url(#flowOutlineCircleShadow)" class="flow-node-c3"/>
                    <text x="840" y="142" text-anchor="middle" class="flow-svg-num">03</text>
                    <text x="840" y="162" text-anchor="middle" class="flow-svg-title">Dönüşüm &amp; Rutin</text>
                    <text x="840" y="178" text-anchor="middle" class="flow-svg-sub">Kalıcı Yaşam</text>
                </g>
            </svg>
        </div>

        <!-- 6. Dairelerin Altındaki 3'lü Genel Dönüşüm Özeti (Kutular Kaldırıldı, Sade & Ferah) -->
        <div class="flow-summary-grid">
            <div class="flow-summary-col" id="flowSummary1">
                <h4 class="flow-summary-title">01 / Kayıt &amp; Beden Analizi</h4>
                <p class="flow-summary-desc">Platformda profilini oluştur; başlangıç eklem mobilitesi ve postür analizini tamamlayarak hedefini belirle.</p>
            </div>
            <div class="flow-summary-col" id="flowSummary2">
                <h4 class="flow-summary-title title-bordo">02 / Canlı Seanslar &amp; Rehberlik</h4>
                <p class="flow-summary-desc">Fizyoterapist rehberliğinde diyafram nefesi, vagus regülasyonu ve eklem açıcı akışlarla sempatik stresi kır.</p>
            </div>
            <div class="flow-summary-col" id="flowSummary3">
                <h4 class="flow-summary-title">03 / Sürdürülebilir Longevity</h4>
                <p class="flow-summary-desc">Kazanılan hareket disiplini ve hücresel canlılıkla, ömür boyu ağrısız ve yüksek enerjili bir yaşam rutini kur.</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. Bölüm II: ÖNE ÇIKAN DİJİTAL PROGRAM (SCHEDULE & OFFERINGS) -->
<section class="featured-offer-section" id="featured-program">
    <div class="container">
        <div class="offer-split-frame">
            <!-- Sol: İkonik Bordo Vurgu Kartı -->
            <div class="offer-left-accent">
                <div class="offer-badge-box">EN ÇOK TERCİH EDİLEN PROGRAM</div>
                
                <div class="offer-main-title-wrap">
                    <div class="offer-duration-num">4 HAFTA</div>
                    <div class="offer-format-label">Online Canlı Yoga & Metabolik Detox Kampı</div>
                </div>

                <div class="offer-price-block">
                    <span class="price-prefix">Toplam Yatırım</span>
                    <div class="price-amount">₺4.500</div>
                    <span class="price-subtext">Kayıt Seanslar + Birebir Eğitmen Rehberliği</span>
                </div>

                <div class="offer-cta-box">
                    <a href="<?= url('/checkout/1') ?>" class="btn-pill-solid" style="display: block; text-align: center;">
                        KAMPA HEMEN KATIL &rarr;
                    </a>
                </div>
            </div>

            <!-- Sağ: Mimari Çizgili Müfredat & Liste Yapısı (Schedule List) -->
            <div class="offer-right-schedule">
                <div class="schedule-header">
                    <span class="section-kicker">MÜFREDAT & KAPSAM</span>
                    <h3 class="schedule-title">Programda Seni Neler Bekliyor?</h3>
                </div>

                <div class="schedule-list">
                    <div class="schedule-row">
                        <span class="schedule-num">01 /</span>
                        <div class="schedule-info">
                            <strong>Haftalık Canlı Seanslar</strong>
                            <p>Fizyoterapist gözetiminde canlı yoga, mobilite ve postür düzeltici akışlar.</p>
                        </div>
                    </div>

                    <div class="schedule-row">
                        <span class="schedule-num">02 /</span>
                        <div class="schedule-info">
                            <strong>Birebir WhatsApp Takibi</strong>
                            <p>Her gün kişisel alışkanlık kontrolü, soru-cevap ve sürekli eğitmen motivasyonu.</p>
                        </div>
                    </div>

                    <div class="schedule-row">
                        <span class="schedule-num">03 /</span>
                        <div class="schedule-info">
                            <strong>Sabah Rutinleri & Challenge'lar</strong>
                            <p>Güne zinde başlamanı sağlayan mikro hareket serileri ve farkındalık görevleri.</p>
                        </div>
                    </div>

                    <div class="schedule-row">
                        <span class="schedule-num">04 /</span>
                        <div class="schedule-info">
                            <strong>Glisemik Dengeli Beslenme Rehberi</strong>
                            <p>Rafine şekersiz, kan şekerini sabitleyen lezzetli tarifler ve öğün planlaması.</p>
                        </div>
                    </div>

                    <div class="schedule-row">
                        <span class="schedule-num">05 /</span>
                        <div class="schedule-info">
                            <strong>GLP-1 & Tokluk Yönetimi</strong>
                            <p>Açlık ve tatlı krizlerini biyolojik olarak yönetme stratejileri.</p>
                        </div>
                    </div>
                </div>

                <div class="schedule-bottom-action">
                    <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%204%20Haftal%C4%B1k%20Online%20Detox%20kamp%C4%B1%20hakk%C4%B1nda%20dan%C4%B1%C5%9Fmak%20istiyorum." 
                       target="_blank" rel="noopener noreferrer" 
                       class="btn-schedule-wa">
                        WHATSAPP İLE SORU SOR &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Bölüm IV: İMZA STÜDYO KONSEPTLERİ (3'lü Kart Izgarası) -->
<section class="editorial-concepts-section">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-kicker">02 / DENEYİMLER</span>
            <h2 class="section-heading-lg">İmza Wellness Konseptleri</h2>
            <p class="section-lead-muted">Stüdyoda, açık havada ve su üzerinde özgün pratikler.</p>
        </div>

        <div class="concepts-grid-3">
            <!-- 1. Warrior Yoga -->
            <article class="concept-editorial-card">
                <span class="concept-index">01 / DİNAMİK AKIŞ</span>
                <h3 class="concept-title">Warrior Yoga</h3>
                <p class="concept-description">
                    Güç ve dayanıklılık odaklı yüksek tempolu grup seansı. Kalori harcatırken eklemleri anatomik olarak korur.
                </p>
                <div class="concept-action">
                    <a href="<?= url('/programs') ?>" class="btn-pill-outline-dark">PROGRAMI İNCELE &rarr;</a>
                </div>
            </article>

            <!-- 2. Platform & SUP Yoga -->
            <article class="concept-editorial-card">
                <span class="concept-index">02 / SU ÜZERİNDE DENGE</span>
                <h3 class="concept-title">Platform & SUP Yoga</h3>
                <p class="concept-description">
                    Adana gölü üzerinde suyla bütünleşen, derin merkez (core) gücünü ve zihinsel odaklanmayı zirveye taşıyan seanslar.
                </p>
                <div class="concept-action">
                    <a href="<?= url('/events') ?>" class="btn-pill-outline-dark">ETKİNLİKLER &rarr;</a>
                </div>
            </article>

            <!-- 3. Outdoor Community Yoga -->
            <article class="concept-editorial-card">
                <span class="concept-index">03 / AÇIK HAVA TOPLULUĞU</span>
                <h3 class="concept-title">Outdoor Community Yoga</h3>
                <p class="concept-description">
                    Parklarda, marinalarda ve tarihi dokularda yüzlerce katılımcıyla buluşan sosyal ve birleştirici iyi yaşam buluşmaları.
                </p>
                <div class="concept-action">
                    <a href="<?= url('/events') ?>" class="btn-pill-outline-dark">TOPLULUĞA KATIL &rarr;</a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- 6. Bölüm V: GERÇEK DÖNÜŞÜMLER (3D DÖNEN BEFORE / AFTER SİLİNDİRİK KARTLAR) -->
<section class="transformation-3d-section" id="donusum">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-kicker">GERÇEK DENEYİMLER</span>
            <h2 class="section-heading-lg">Dönüşüm Hikayeleri</h2>
            <p class="section-lead-muted">Kartları sürükleyerek 3D olarak döndürün, öncesi ve sonrasını görmek için kartlara tıklayın.</p>
        </div>
    </div>

    <div class="carousel-3d-wrapper" id="carousel3dWrapper">
        <div class="carousel-3d-scene">
            <div class="carousel-3d-ring" id="carousel3dRing">
                <!-- Kart 1 -->
                <div class="carousel-3d-card" data-index="0" style="--card-index: 0;">
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
                <div class="carousel-3d-card" data-index="1" style="--card-index: 1;">
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
                <div class="carousel-3d-card" data-index="2" style="--card-index: 2;">
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
                <div class="carousel-3d-card" data-index="3" style="--card-index: 3;">
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
                <div class="carousel-3d-card" data-index="4" style="--card-index: 4;">
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
                <div class="carousel-3d-card" data-index="5" style="--card-index: 5;">
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

        <!-- 3D Carousel Kontrolleri (Oklar) -->
        <div class="carousel-3d-controls">
            <button type="button" class="carousel-control-btn btn-prev" id="carouselPrevBtn" aria-label="Önceki">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </button>
            <button type="button" class="carousel-control-btn btn-next" id="carouselNextBtn" aria-label="Sonraki">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- 8. Bölüm VI: EĞİTMENLE TANIŞIN (MEET YOUR MENTOR) -->
<section class="editorial-mentor-section">
    <div class="container">
        <div class="mentor-frame-grid">
            <!-- Sol: İkonik Portre / Monogram Çerçeve -->
            <div class="mentor-portrait-col">
                <div class="mentor-avatar-box">
                    <span class="mentor-initials">BT</span>
                </div>
                <div class="mentor-meta">
                    <h3 class="mentor-name">Betina Tansuğ</h3>
                    <p class="mentor-role">Fizyoterapist & Yoga Eğitmeni</p>
                </div>
            </div>

            <!-- Sağ: Felsefe & Öz Biyografi -->
            <div class="mentor-bio-col">
                <span class="section-kicker">KURUCU & EĞİTMEN</span>
                <h2 class="mentor-quote">
                    "Hareketi yalnızca fiziksel bir pratik değil, beden ve zihin arasında kurulan <em>en güçlü iletişim</em> olarak görüyorum."
                </h2>
                <p class="mentor-text">
                    Amacım; insan anatomisini merkeze alan bilimsel fizyoterapi yaklaşımlarını yoga disipliniyle harmanlayarak, iyi yaşamı herkes için sürdürülebilir, güvenli ve keyifli bir günlük rutine dönüştürmektir.
                </p>

                <div class="mentor-credentials-list">
                    <div class="cred-item">
                        <span class="cred-check">✓</span>
                        <span>Fizyoterapi ve Rehabilitasyon Bilimsel Temeli</span>
                    </div>
                    <div class="cred-item">
                        <span class="cred-check">✓</span>
                        <span>Uluslararası Sertifikalı Yoga & Longevity Eğitmeni</span>
                    </div>
                    <div class="cred-item">
                        <span class="cred-check">✓</span>
                        <span>17+ Tamamlanan Kamp & 100+ Başarılı Katılımcı Deneyimi</span>
                    </div>
                </div>

                <div style="margin-top: 2rem;">
                    <a href="<?= url('/metod') ?>" class="btn-pill-solid-dark">
                        METODU VE ALTYAPIYI İNCELE &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. Bölüm VI: KATILIMCI YORUMU (EDITORIAL TESTIMONIAL) -->
<section class="editorial-testimonial-section">
    <div class="container">
        <div class="testimonial-editorial-box">
            <div class="stars-row">★★★★★</div>
            <blockquote class="testimonial-blockquote">
                "Bu kampın bana en güzel hissettirdiği şey her sabah yeni bir challenge ile uyanmaktı. 
                Gün içinde kendim için yaptığım küçük şeyler bile motivasyonumu artırdı. 
                Hem yeni tarifler keşfettim hem de sağlıklı beslenmenin aslında zor olmadığını gördüm. 
                En güzeli de hiçbir baskı hissetmeden sürecin içinde kalabilmekti..."
            </blockquote>
            <cite class="testimonial-author-cite">— Online Kamp Katılımcısı • 4 Haftalık Dönem</cite>
        </div>
    </div>
</section>
