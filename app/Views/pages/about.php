<?php
declare(strict_types=1);
$bData = function_exists('page_data') ? page_data('betina') : [];

$photo1 = !empty($bData['betina_photo1']) ? $bData['betina_photo1'] : 'assets/images/betina-outdoor-stretch.jpg';
if (!str_starts_with($photo1, 'http') && !str_starts_with($photo1, '/fizyobar')) {
    $photo1 = asset(ltrim($photo1, '/'));
}
$photo2 = !empty($bData['betina_photo2']) ? $bData['betina_photo2'] : 'assets/images/betina-outdoor-inversion.jpg';
if (!str_starts_with($photo2, 'http') && !str_starts_with($photo2, '/fizyobar')) {
    $photo2 = asset(ltrim($photo2, '/'));
}

$bioHeading = $bData['betina_bio_heading'] ?? 'KLİNİK FİZYOTERAPİST • BAR SYSTEM KURUCUSU';
$bioPara1 = $bData['betina_bio_para1'] ?? 'Fizyoterapist kimliğim sayesinde insan bedenini anatomik, biyomekanik ve fonksiyonel açıdan ele alıyor; yoga ve mobilite pratiğini kanıta dayalı bilimsel bir temele oturtuyorum.';
$bioPara2 = $bData['betina_bio_para2'] ?? 'Hareketi dönemsel bir heves değil; omurga sağlığını, eklem mobilitesini ve otonom sinir sistemi dengesini koruyan, uzun ve ağrısız bir ömür için kalıcı bir yaşam disiplini haline getiriyoruz.';

$methodHeading = $bData['betina_method_heading'] ?? 'BAR SYSTEM NEDİR?';
$methodDesc = $bData['betina_method_desc'] ?? 'Klinik fizyoterapi temelli hareket bilimi ile yoga disiplinini birleştiren; omurga sağlığını, vagus sinir regülasyonunu ve longevity odaklı kalıcı bir yaşam disiplinini koruyan patentli metodumuz.';

$actionBtnText = $bData['betina_action_btn_text'] ?? 'PROGRAMLARI İNCELE →';
$actionBtnLink = $bData['betina_action_btn_link'] ?? '/programs';
if (!empty($actionBtnLink) && !str_starts_with($actionBtnLink, 'http') && !str_starts_with($actionBtnLink, '/fizyobar')) {
    $actionBtnLink = url($actionBtnLink);
}
?>

<!-- WE/AR© REFERANS BİREBİR EDİTORYAL SPLIT-PANEL VİTRİNİ -->
<section class="betina-showcase-section">
    <div class="betina-showcase-shell">
        
        <!-- 1. SOL KART (FOTOĞRAF 1) -->
        <div class="showcase-card showcase-card-1">
            <!-- Fotoğraf Katmanı (Hover ile Renklenir) -->
            <div class="showcase-img-wrap">
                <img src="<?= e($photo1) ?>" 
                     alt="Betina Tansuğ - Biyomekanik &amp; Yoga Pratiği" 
                     class="showcase-img" 
                     loading="eager">
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
            <!-- Fotoğraf Katmanı (Hover ile Renklenir) -->
            <div class="showcase-img-wrap">
                <img src="<?= e($photo2) ?>" 
                     alt="Betina Tansuğ - BAR System &amp; Mobilite" 
                     class="showcase-img" 
                     loading="eager">
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
                    <h2 class="showcase-bio-heading"><?= e($bioHeading) ?></h2>
                    <p class="showcase-bio-para">
                        <?= e($bioPara1) ?>
                    </p>
                    <p class="showcase-bio-subpara">
                        <?= e($bioPara2) ?>
                    </p>
                </div>

                <!-- 3 Sütunlu Editoryal Matris -->
                <div class="showcase-columns-grid">
                    
                    <!-- Sütun 1: BLOGLARDAN SEÇMELER -->
                    <div class="showcase-col-group">
                        <div class="showcase-col">
                            <span class="showcase-col-title">BLOGLARDAN SEÇMELER</span>
                            <ul class="showcase-links-list">
                                <li><a href="<?= url('/blog?id=1') ?>">4 HAFTALIK DÖNÜŞÜM YOLCULUĞU</a></li>
                                <li><a href="<?= url('/blog?id=2') ?>">5 DAKİKALIK MOBİLİTE SERİSİ</a></li>
                                <li><a href="<?= url('/blog?id=3') ?>">GLP-1 &amp; KAN ŞEKERİ DENGESİ</a></li>
                                <li><a href="<?= url('/blog') ?>">FASYA AĞI &amp; POSTÜR</a></li>
                                <li><a href="<?= url('/blog') ?>">TÜM BLOG YAZILARI &rarr;</a></li>
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

            <!-- Alt Telif Satırı -->
            <div class="showcase-footer-row">
                <p class="showcase-copyright-text">
                    FİZYOBAR &bull; BETİNA TANSUĞ İSTANBUL &bull; &copy; <?= date('Y') ?>
                </p>
            </div>
        </div>

    </div>
</section>

<!-- BAR SYSTEM METODOLOJİSİ & BİLİMSEL DERİNLİK (STICKY SAĞ PANEL & SOL KAYAN METİNLER) -->
<section class="betina-barsystem-section corp-work-section" id="bar-system" style="border-top: 1px solid rgba(255, 255, 255, 0.12); padding-top: clamp(4rem, 6vw, 6rem); margin-bottom: clamp(4.5rem, 8vw, 7.5rem);">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">
        
        <div class="barsystem-sticky-split">
            <!-- Sol Kolon: Numaralandırılmış Çizgili 4 Metodoloji Maddesi (KAYAN YAZI ALANI) -->
            <div class="barsystem-scroll-left">
                <!-- 01 / BODY -->
                <div class="corp-service-item">
                    <div class="service-item-main">
                        <span style="font-family: var(--font-display); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(255, 255, 255, 0.65); display: block; margin-bottom: 0.4rem;">
                            01 / BODY &bull; KLİNİK ANATOMİ
                        </span>
                        <h3 class="service-item-name" style="color: #ffffff; font-size: clamp(1.2rem, 1.8vw, 1.35rem);">BİYOMEKANİK DENGE &amp; OMURGA DEKOMPRESYONU</h3>
                        <p class="service-item-desc" style="color: rgba(255, 255, 255, 0.8); line-height: 1.75; font-size: 0.96rem;">
                            Fizyoterapist kimliğimle geliştirdiğim bu aşamada, beden anatomik ve biyomekanik prensipler doğrultusunda ele alınır. Eklem mobilitesi korunarak omurga anatomik ekseninde yeniden hizalanır ve günlük yaşamın yarattığı baskı ve kompresyon hafifletilir.
                        </p>
                    </div>
                    <span class="service-item-number" style="color: rgba(255, 255, 255, 0.45); font-size: 1.25rem;">01 /</span>
                </div>

                <!-- 02 / ADAPT -->
                <div class="corp-service-item">
                    <div class="service-item-main">
                        <span style="font-family: var(--font-display); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(255, 255, 255, 0.65); display: block; margin-bottom: 0.4rem;">
                            02 / ADAPT &bull; SİNİR SİSTEMİ ONARIMI
                        </span>
                        <h3 class="service-item-name" style="color: #ffffff; font-size: clamp(1.2rem, 1.8vw, 1.35rem);">NÖRO-BİYOLOJİK REGÜLASYON &amp; DİYAFRAM</h3>
                        <p class="service-item-desc" style="color: rgba(255, 255, 255, 0.8); line-height: 1.75; font-size: 0.96rem;">
                            Fiziksel güç kadar sinir sisteminin regülasyonu da esastır. Diyafram nefesi ve vagus siniri uyarımı aracılığıyla, bedenin sürekli alarmda olan sempatik stres hali yatıştırılır ve beden onarıcı parasempatik moda geçirilir.
                        </p>
                    </div>
                    <span class="service-item-number" style="color: rgba(255, 255, 255, 0.45); font-size: 1.25rem;">02 /</span>
                </div>

                <!-- 03 / REFRAME -->
                <div class="corp-service-item">
                    <div class="service-item-main">
                        <span style="font-family: var(--font-display); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(255, 255, 255, 0.65); display: block; margin-bottom: 0.4rem;">
                            03 / REFRAME &bull; YAŞAM DİSİPLİNİ
                        </span>
                        <h3 class="service-item-name" style="color: #ffffff; font-size: clamp(1.2rem, 1.8vw, 1.35rem);">SÜRDÜRÜLEBİLİR LONGEVITY &amp; HÜCRESEL CANLILIK</h3>
                        <p class="service-item-desc" style="color: rgba(255, 255, 255, 0.8); line-height: 1.75; font-size: 0.96rem;">
                            Hareketi dönemsel bir heves veya zorlayıcı bir ceza olmaktan çıkarıp, uzun ve ağrısız bir ömür için kalıcı bir yaşam disiplinine dönüştürüyoruz. Mitokondriyal kapasite ve fonksiyonel esneklik desteklenir.
                        </p>
                    </div>
                    <span class="service-item-number" style="color: rgba(255, 255, 255, 0.45); font-size: 1.25rem;">03 /</span>
                </div>

                <!-- 04 / DÖNÜŞÜM -->
                <div class="corp-service-item">
                    <div class="service-item-main">
                        <span style="font-family: var(--font-display); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(255, 255, 255, 0.65); display: block; margin-bottom: 0.4rem;">
                            04 / DÖNÜŞÜM &bull; KAMP &amp; PRATİK
                        </span>
                        <h3 class="service-item-name" style="color: #ffffff; font-size: clamp(1.2rem, 1.8vw, 1.35rem);">17+ DÖNEM BİLİMSEL TAKİP &amp; SONUÇLAR</h3>
                        <p class="service-item-desc" style="color: rgba(255, 255, 255, 0.8); line-height: 1.75; font-size: 0.96rem;">
                            Yüzlerce katılımcının omurga, postür ve beslenme dönüşümüne eşlik eden; klinik fizyoterapi ve otonom sinir sistemi regülasyonuyla taçlandırılmış patentli metodumuz.
                        </p>
                    </div>
                    <span class="service-item-number" style="color: rgba(255, 255, 255, 0.45); font-size: 1.25rem;">04 /</span>
                </div>
            </div>

            <!-- Sağ Kolon: Sabit Kalan Başlık • Açıklama • Uzatılmış Görsel (STICKY) -->
            <div class="barsystem-sticky-right">
                <span class="barsystem-kicker-label">
                    METODOLOJİ &bull; BİYOMEKANİK &bull; LONGEVITY
                </span>
                <h2 class="corp-work-headline barsystem-sticky-title">
                    BAR SYSTEM<br>
                    METODOLOJİSİ
                </h2>
                <p class="corp-work-desc barsystem-sticky-desc">
                    <?= e($methodDesc) ?>
                </p>

                <!-- Uzatılmış Görsel Alanı -->
                <div class="barsystem-work-visual">
                    <img src="<?= asset('assets/images/betina-studio-forward-fold.jpg') ?>" 
                         alt="BAR System - Klinik Anatomi &amp; Biyomekanik" 
                         class="barsystem-visual-img"
                         loading="lazy">
                    <div class="barsystem-visual-caption">
                        KLİNİK FİZYOTERAPİ &bull; HİZALANMA PRATİĞİ
                    </div>
                </div>
            </div>
        </div>

        <!-- Alt Manifesto & Programlara Yönlendirme Bannerı -->
        <div style="background: #252324; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 20px; padding: 2.5rem clamp(1.5rem, 4vw, 3rem); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25); margin-top: clamp(3.5rem, 6vw, 5rem);">
            <div style="max-width: 680px;">
                <h4 style="font-family: var(--font-display); font-size: 1.45rem; font-weight: 700; color: #ffffff; margin: 0 0 0.6rem; text-transform: uppercase;">
                    "BEDENİNLE YENİDEN BAĞ KURMAYA HAZIR MISIN?"
                </h4>
                <p style="font-size: 0.92rem; font-weight: 300; line-height: 1.65; color: rgba(255, 255, 255, 0.70); margin: 0;">
                    17+ dönem boyunca yüzlerce katılımcının omurga ve beden dönüşümüne eşlik eden BAR System programlarına hemen katılabilirsiniz.
                </p>
            </div>
            <a href="<?= e($actionBtnLink) ?>" class="card-action-btn" style="padding: 1rem 2.2rem; font-size: 0.95rem; font-weight: 700; background: #ffffff; color: #111111; text-decoration: none; border-radius: 999px; display: inline-block; text-transform: uppercase; letter-spacing: 0.08em; transition: all 0.3s ease;">
                <?= e($actionBtnText) ?>
            </a>
        </div>

    </div>
</section>
