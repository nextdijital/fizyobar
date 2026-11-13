<?php
declare(strict_types=1);
/**
 * @var string|null $flashSuccess
 */
?>

<!-- ==============================================================================
     FİZYOBAR KURUMSAL (EDİTORYAL BRUTALIST & MİLANO MİMARİSİ)
     ============================================================================== -->
<div class="corp-agency-page">
    <div class="container">
        <!-- 1. Üst Başlık & Giriş Metni (Ortalanmış Başlık ve Metin) -->
        <header class="corp-agency-header text-center">
            <h1 class="corp-agency-title">KURUMSAL WELLBEING</h1>
            <p class="corp-agency-lead">
                Fizyoterapi temelli hareket bilimi, omurga biyomekaniği ve ergonomik iyi yaşam çözümleriyle kurumunuzun insan sermayesini güçlendiriyor, tükenmişliği önlüyor ve ekibinizin zihinsel-fiziksel üretkenliğini en üst seviyeye taşıyoruz.
            </p>
        </header>

        <!-- 3. Değerlerimiz / 4'lü Kart Grid (OUR VALUES) - Kart İçi Canlı Fotoğraflar & Beyaz Gölge -->
        <section class="corp-values-section" aria-label="Kurumsal Değerlerimiz">
            <div class="corp-values-grid">
                <!-- Kart 1: Değerlerimiz İndeks Kartı (Ok İkonu & Başlık) -->
                <div class="corp-value-card card-index-action">
                    <div class="value-card-top-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                    <div class="value-card-bottom-label">
                        <span class="card-kicker-small">FİZYOBAR</span>
                        <h3 class="card-lead-heading">KURUMSAL<br>DEĞERLERİMİZ</h3>
                    </div>
                </div>

                <!-- Kart 2: Şeffaflık & Bilimsellik (Kart İçi Canlı Renkli Görsel + Yazı) -->
                <div class="corp-value-card card-with-photo">
                    <div class="value-card-header">
                        <h3 class="value-card-title">ŞEFFAFLIK &amp; BİLİMSELLİK</h3>
                    </div>
                    <div class="value-card-photo-box">
                        <img src="<?= asset('assets/images/betina-user-photo1.jpg') ?>" 
                             alt="Fizyobar Şeffaflık & Bilimsellik" 
                             class="value-card-img" 
                             loading="lazy">
                    </div>
                    <div class="value-card-body">
                        <p class="value-card-text">
                            Kanıta dayalı klinik fizyoterapi ve anatomi verileriyle çalışır; tüm süreçlerde kurumunuza ölçülebilir, somut kazanımlar sunarız.
                        </p>
                    </div>
                </div>

                <!-- Kart 3: Sonuç Odaklılık (Kart İçi Canlı Renkli Görsel + Yazı) -->
                <div class="corp-value-card card-with-photo">
                    <div class="value-card-header">
                        <h3 class="value-card-title">ÖLÇÜLEBİLİR SONUÇ</h3>
                    </div>
                    <div class="value-card-photo-box">
                        <img src="<?= asset('assets/images/betina-user-photo2.jpg') ?>" 
                             alt="Fizyobar Ölçülebilir Sonuç" 
                             class="value-card-img" 
                             loading="lazy">
                    </div>
                    <div class="value-card-body">
                        <p class="value-card-text">
                            Masa başı çalışanların duruş bozuklukları, boyun ve bel gerginliklerini kalıcı biçimde azaltarak ekip motivasyonunu yükseltiriz.
                        </p>
                    </div>
                </div>

                <!-- Kart 4: Yenilikçilik & Ergonomi (Kart İçi Canlı Renkli Görsel + Yazı) -->
                <div class="corp-value-card card-with-photo">
                    <div class="value-card-header">
                        <h3 class="value-card-title">YENİLİKÇİ ERGONOMİ</h3>
                    </div>
                    <div class="value-card-photo-box">
                        <img src="<?= asset('assets/images/betina-studio-forward-fold.jpg') ?>" 
                             alt="Fizyobar Yenilikçi Ergonomi" 
                             class="value-card-img" 
                             loading="lazy">
                    </div>
                    <div class="value-card-body">
                        <p class="value-card-text">
                            Geleneksel seminerler yerine interaktif ofis hareket molaları, GLP-1 beslenme ve vagus nefes protokolleri uygularız.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Nelerle Çalışıyoruz & Çözümlerimiz (WHAT WE WORK WITH Split Mimarisi) -->
        <section class="corp-work-section" aria-label="Kurumsal Çözümlerimiz">
            <div class="corp-work-split">
                <!-- Sol Kolon: Büyük Başlık • Açıklama -->
                <div class="corp-work-left">
                    <h2 class="corp-work-headline">
                        NELERLE<br>
                        ÇALIŞIYORUZ
                    </h2>
                    <p class="corp-work-desc">
                        Çalışanlarınızın ofis ergonomisini güçlendirmek, boyun ve bel gerginliklerini gidermek ya da kurumsal motivasyon ve üretkenliği artırmak olsun; hedeflerinize en verimli şekilde ulaşmanız için kanıta dayalı fizyoterapi çözümleri üretiyoruz.
                    </p>
                </div>

                <!-- Sağ Kolon: Numaralandırılmış Çizgili Hizmet Listesi -->
                <div class="corp-work-right">
                    <!-- Servis 1 -->
                    <div class="corp-service-item">
                        <div class="service-item-main">
                            <h3 class="service-item-name">OFİS ERGONOMİSİ &amp; POSTÜR ATÖLYESİ</h3>
                            <p class="service-item-desc">
                                Masa başı çalışanlar için servikal omurga dekompresyonu, ekran-koltuk hizalanması ve iş günü içine entegre edilen mikro hareket molaları.
                            </p>
                        </div>
                        <span class="service-item-number">01 /</span>
                    </div>

                    <!-- Servis 2 -->
                    <div class="corp-service-item">
                        <div class="service-item-main">
                            <h3 class="service-item-name">KURUMSAL YOGA &amp; HAREKET SEANSLARI</h3>
                            <p class="service-item-desc">
                                Şirket ofisinde veya online canlı yayınla eklemleri rahatlatan, duruşu güçlendiren ve gün ortası zihinsel netlik kazandıran akışlar.
                            </p>
                        </div>
                        <span class="service-item-number">02 /</span>
                    </div>

                    <!-- Servis 3 -->
                    <div class="corp-service-item">
                        <div class="service-item-main">
                            <h3 class="service-item-name">METABOLİK BESLENME &amp; GLP-1 WEBINARLARI</h3>
                            <p class="service-item-desc">
                                Gün ortası şeker çökmelerini, halsizliği ve beyin sisini önleyen; rafine şekersiz, doğal doygunluk odaklı mutfak kılavuzları.
                            </p>
                        </div>
                        <span class="service-item-number">03 /</span>
                    </div>

                    <!-- Servis 4 -->
                    <div class="corp-service-item">
                        <div class="service-item-main">
                            <h3 class="service-item-name">YÖNETİCİ REHBERLİĞİ &amp; VAGUS STRES REGÜLASYONU</h3>
                            <p class="service-item-desc">
                                Lider kadro ve yüksek baskı altındaki ekipler için vagus siniri uyarımı, diyafram nefesi mekaniği ve otonom sinir sistemi sakinliği.
                            </p>
                        </div>
                        <span class="service-item-number">04 /</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
