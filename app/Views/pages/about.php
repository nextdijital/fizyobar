<?php
declare(strict_types=1);
?>

<!-- WE/AR© REFERANS BİREBİR EDİTORYAL SPLIT-PANEL VİTRİNİ -->
<section class="betina-showcase-section">
    <div class="betina-showcase-shell">
        
        <!-- 1. SOL KART (FOTOĞRAF 1) -->
        <div class="showcase-card showcase-card-1">
            <!-- Sol Ortadaki Yatay Beyaz Vurgu Bloğu -->
            <div class="showcase-accent-block" aria-hidden="true"></div>

            <!-- Fotoğraf Katmanı (Hover ile Renklenir) -->
            <div class="showcase-img-wrap">
                <img src="<?= asset('assets/images/betina-outdoor-stretch.jpg') ?>" 
                     alt="Betina Tansuğ - Biyomekanik &amp; Yoga Pratiği" 
                     class="showcase-img" 
                     loading="eager">
            </div>

            <!-- Üst Kontroller: Sol Yuvarlak Buton & Sağda YENİ -->
            <div class="card-top-controls">
                <a href="<?= url('/') ?>" class="card-back-circle" title="Ana Sayfaya Dön" aria-label="Geri Dön">
                    &larr;
                </a>
                <span class="card-top-badge">YENİ</span>
            </div>

            <!-- Alt Editoryal Bilgi & Beyaz Buton (Yumuşak Oval Hatlar) -->
            <div class="card-bottom-info">
                <span class="card-code">SERİ #028</span>
                <p class="card-caption">
                    KLİNİK ANATOMİ VE BİYOMEKANİK TEMELİNDE BEDENİNİZLE YENİDEN BAĞ KURUN.
                </p>
                <a href="<?= url('/programs') ?>" class="card-action-btn">
                    BİYOGRAFİ
                </a>
            </div>
        </div>

        <!-- 2. ORTA KART (FOTOĞRAF 2) -->
        <div class="showcase-card showcase-card-2">
            <!-- Sol Üstteki Dikey Beyaz Vurgu Bloğu -->
            <div class="showcase-accent-block" aria-hidden="true"></div>

            <!-- Fotoğraf Katmanı (Hover ile Renklenir) -->
            <div class="showcase-img-wrap">
                <img src="<?= asset('assets/images/betina-outdoor-inversion.jpg') ?>" 
                     alt="Betina Tansuğ - BAR System &amp; Mobilite" 
                     class="showcase-img" 
                     loading="eager">
            </div>

            <!-- Üst Kontroller -->
            <div class="card-top-controls">
                <span class="card-top-badge">BAR SYSTEM</span>
            </div>

            <!-- Alt Editoryal Bilgi & Şeffaf Outline Buton (Yumuşak Oval Hatlar) -->
            <div class="card-bottom-info">
                <span class="card-code">METOD #172</span>
                <p class="card-caption">
                    17+ DÖNEM ONLİNE KAMP DENEYİMİ VE YÜZLERCE BİLİMSEL DÖNÜŞÜM HİKAYESİ.
                </p>
                <a href="<?= url('/programs') ?>" class="card-action-btn btn-outline-white">
                    PROGRAMLAR
                </a>
            </div>
        </div>

        <!-- 3. SAĞ EDİTORYAL PANEL (BETİNA TANSUĞ BİYOGRAFİ & AÇIKLAMA) -->
        <div class="showcase-info-panel">
            <div class="showcase-header-wrap">
                <!-- Büyük Tipografik Başlık: BETİNA TANSUĞ© -->
                <h1 class="showcase-main-title">BETİNA TANSUĞ&copy;</h1>

                <!-- Alt Meta Satırı -->
                <div class="showcase-sub-meta">
                    <span class="sub-meta-left">HAREKETİN BİLİMSEL DÖNÜŞÜMÜ &rarr;</span>
                    <span class="sub-meta-right">EST. 2020</span>
                </div>

                <!-- Yönlendirme Oku -->
                <div class="showcase-scroll-arrow" aria-hidden="true">&darr;</div>

                <!-- Betina Tansuğ Kimdir Açıklama Alanı (Editoryal Manifesto) -->
                <div class="showcase-bio-box">
                    <h2 class="showcase-bio-heading">KLİNİK FİZYOTERAPİST &bull; BAR SYSTEM KURUCUSU</h2>
                    <p class="showcase-bio-para">
                        Fizyoterapist kimliğim sayesinde insan bedenini anatomik, biyomekanik ve fonksiyonel açıdan ele alıyor; yoga ve mobilite pratiğini kanıta dayalı bilimsel bir temele oturtuyorum.
                    </p>
                    <p class="showcase-bio-subpara">
                        Hareketi dönemsel bir heves değil; omurga sağlığını, eklem mobilitesini ve otonom sinir sistemi dengesini koruyan, uzun ve ağrısız bir ömür için kalıcı bir yaşam disiplini haline getiriyoruz.
                    </p>
                </div>

                <!-- 3 Sütunlu Editoryal Matris -->
                <div class="showcase-columns-grid">
                    
                    <!-- Sütun 1: UZMANLIK & METODOLOJİ -->
                    <div class="showcase-col-group">
                        <div class="showcase-col">
                            <span class="showcase-col-title">METODOLOJİ</span>
                            <ul class="showcase-links-list">
                                <li>KLİNİK ANATOMİ</li>
                                <li>POSTÜR &amp; HİZALANMA</li>
                                <li>EKLEM MOBİLİTESİ</li>
                                <li>VAGUS SİNİR DENGESİ</li>
                                <li>LONGEVITY RUTİNLERİ</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Sütun 2: PROGRAMLAR & DENEYİMLER -->
                    <div class="showcase-col-group">
                        <div class="showcase-col">
                            <span class="showcase-col-title">PROGRAMLAR</span>
                            <ul class="showcase-links-list">
                                <li><a href="<?= url('/programs') ?>">4 HAFTALIK DETOKS KAMPI</a></li>
                                <li><a href="<?= url('/studio') ?>">ONLİNE STUDIO DERSLERİ</a></li>
                                <li><a href="<?= url('/corporate') ?>">BİREBİR KLİNİK SEANSLAR</a></li>
                                <li><a href="<?= url('/events') ?>">PLATFORM &amp; SUP YOGA</a></li>
                                <li><a href="<?= url('/corporate') ?>">KURUMSAL WELLNESS</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Sütun 3: TAKİP & İLETİŞİM -->
                    <div class="showcase-col-group">
                        <div class="showcase-col">
                            <span class="showcase-col-title">İLETİŞİM</span>
                            <ul class="showcase-links-list">
                                <li><a href="https://instagram.com/betinatansug" target="_blank" rel="noopener">INSTAGRAM: @betinatansug</a></li>
                                <li><a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener">WHATSAPP DANIŞMA</a></li>
                                <li><a href="https://youtube.com" target="_blank" rel="noopener">YOUTUBE KANALI</a></li>
                                <li><a href="https://spotify.com" target="_blank" rel="noopener">SPOTIFY ÇALMA LİSTELERİ</a></li>
                                <li><a href="mailto:info@fizyobar.com">E-POSTA: info@fizyobar.com</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Alt Telif & Kare Artı Butonu -->
            <div class="showcase-footer-row">
                <p class="showcase-copyright-text">
                    FİZYOBAR &bull; BETİNA TANSUĞ İSTANBUL &bull; &copy; <?= date('Y') ?>
                </p>
                <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="showcase-plus-btn" title="İletişime Geç" aria-label="İletişim">
                    +
                </a>
            </div>
        </div>

    </div>
</section>
