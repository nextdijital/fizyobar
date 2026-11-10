<?php
declare(strict_types=1);
/**
 * @var array|null $camp
 */
?>

<!-- ==============================================================================
     FİZYOBAR: 4 HAFTALIK ONLİNE DETOX & YOGA KAMPI ÖZEL AÇILIŞ SAYFASI
     ============================================================================== -->
<div class="detox-landing-wrapper">
    <!-- 1. Hero Başlık & Tanıtım -->
    <header class="detox-hero-section">
        <div class="container">
            <div class="detox-hero-inner text-center">
                <span class="detox-kicker-pill">🌿 WELLNESS EXPERIENCES • YENİ DÖNEM KAYITLARI AÇILDI</span>
                <h1 class="detox-hero-title">
                    4 HAFTALIK ONLINE<br>DETOX &amp; YOGA KAMPI
                </h1>
                <p class="detox-hero-desc">
                    Fizyoterapist <strong>Betina Tansuğ</strong> rehberliğinde klinik biyomekanik, metabolik farkındalık ve günlük birebir WhatsApp desteğiyle evinizin konforunda baştan sona yenilenin.
                </p>

                <!-- Öne Çıkan Hızlı Metrikler -->
                <div class="detox-metrics-grid">
                    <div class="detox-metric-box">
                        <span class="metric-val">16+</span>
                        <span class="metric-lbl">Canlı Online Seans</span>
                    </div>
                    <div class="detox-metric-box">
                        <span class="metric-val">28 Gün</span>
                        <span class="metric-lbl">Birebir WhatsApp Takibi</span>
                    </div>
                    <div class="detox-metric-box">
                        <span class="metric-val">GLP-1</span>
                        <span class="metric-lbl">Şekersiz Beslenme Kılavuzu</span>
                    </div>
                    <div class="detox-metric-box">
                        <span class="metric-val">∞</span>
                        <span class="metric-lbl">Sınırsız Kayıt Erişimi</span>
                    </div>
                </div>

                <!-- CTA Aksiyon Butonları -->
                <div class="detox-hero-actions">
                    <a href="<?= url('/checkout/1') ?>" class="btn-detox-primary">
                        KAMPA HEMEN KAYIT OL &rarr;
                    </a>
                    <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba%20Betina%20Hocam,%204%20Haftal%C4%B1k%20Online%20Detox%20ve%20Yoga%20Kamp%C4%B1%20hakk%C4%B1nda%20bilgi%20ve%20kontenjan%20dan%C4%B1%C5%9Fmak%20istiyorum." target="_blank" rel="noopener noreferrer" class="btn-detox-outline">
                        WHATSAPP İLE DANIŞ
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Kampa Neler Dahil? (5 Bütüncül Sütun) -->
    <section class="detox-pillars-section">
        <div class="container">
            <div class="section-title-wrap text-center">
                <span class="sub-kicker">BÜTÜNCÜL REHBERLİK</span>
                <h2 class="section-heading">Kampa Neler Dahil?</h2>
                <p class="section-sub-desc">Klasik diyet ya da yüzeysel egzersiz programları yerine bedenin kök nedenlerine odaklanan 5 temel destek:</p>
            </div>

            <div class="detox-pillars-grid">
                <!-- Sütun 1 -->
                <div class="pillar-card">
                    <div class="pillar-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <h3 class="pillar-title">16+ Canlı Seans &amp; Özel Atölyeler</h3>
                    <p class="pillar-desc">
                        Haftada 3-4 gün canlı Zoom seansları. Kaçırsanız veya saat uymasa dahi aynı gün içinde kişisel panelinize HD kayıt olarak eklenir.
                    </p>
                </div>

                <!-- Sütun 2 -->
                <div class="pillar-card">
                    <div class="pillar-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Birebir WhatsApp Takibi</h3>
                    <p class="pillar-desc">
                        Fizyoterapist Betina Tansuğ ile özel WhatsApp grubu ve birebir iletişim. Duruş kontrolleri, ağrı yönetimi ve motivasyon.
                    </p>
                </div>

                <!-- Sütun 3 -->
                <div class="pillar-card">
                    <div class="pillar-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14.93V17a1 1 0 0 1-2 0v-.07A7.003 7.003 0 0 1 5.07 11H5a1 1 0 0 1 0-2h.07A7.003 7.003 0 0 1 11 5.07V5a1 1 0 0 1 2 0v.07A7.003 7.003 0 0 1 18.93 11H19a1 1 0 0 1 0 2h-.07A7.003 7.003 0 0 1 13 16.93z"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Rafine Şekersiz Glisemik Kılavuz</h3>
                    <p class="pillar-desc">
                        Aç kalmadan, kan şekeri dalgalanmalarını durduran ve doğal GLP-1 doygunluğunu uyaran haftalık leziz mutfak tarifleri.
                    </p>
                </div>

                <!-- Sütun 4 -->
                <div class="pillar-card">
                    <div class="pillar-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 12a4 4 0 1 0 8 0 4 4 0 1 0-8 0"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Vagus &amp; Diyafram Nefes Reset</h3>
                    <p class="pillar-desc">
                        Otonom sinir sisteminizi sempatik (stres-kaç) moddan çıkarıp parasempatik dinlenme, sindirim ve hücresel onarım moduna geçiren pratikler.
                    </p>
                </div>

                <!-- Sütun 5 -->
                <div class="pillar-card">
                    <div class="pillar-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Kişisel Hareket Alanı (Movement Space)</h3>
                    <p class="pillar-desc">
                        Kamp boyunca tamamladığınız seansları takip edeceğiniz, interaktif takvim ve ömür boyu erişebileceğiniz video kütüphanesi.
                    </p>
                </div>

                <!-- Sütun 6 -->
                <div class="pillar-card">
                    <div class="pillar-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Klinik Omurga &amp; Postür Düzeltme</h3>
                    <p class="pillar-desc">
                        Boyun düzleşmesi, kamburluk ve bel sıkışmalarını nötrleyen, eklemleri rahatlatan anatomik hareket dizilimleri.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. 4 Haftalık Yol Haritası (Fazlar) -->
    <section class="detox-curriculum-section">
        <div class="container">
            <div class="section-title-wrap text-center">
                <span class="sub-kicker">ADIM ADIM DEĞİŞİM</span>
                <h2 class="section-heading">4 Haftalık Kamp Yol Haritası</h2>
            </div>

            <div class="curriculum-timeline">
                <!-- Hafta 1 -->
                <div class="curriculum-item">
                    <div class="curriculum-num">01</div>
                    <div class="curriculum-body">
                        <span class="curriculum-tag">1. HAFTA</span>
                        <h4 class="curriculum-title">Beden Farkındalığı &amp; Temel Arınma</h4>
                        <p class="curriculum-desc">
                            Rafine şekeri kesme semptomlarını yönetme, bol hidrasyon, eklemleri zorlamayan temel kinestetik yoga seansları ve diyafram solunumu.
                        </p>
                    </div>
                </div>

                <!-- Hafta 2 -->
                <div class="curriculum-item">
                    <div class="curriculum-num">02</div>
                    <div class="curriculum-body">
                        <span class="curriculum-tag">2. HAFTA</span>
                        <h4 class="curriculum-title">Vagus Siniri, Sindirim &amp; Mobilite</h4>
                        <p class="curriculum-desc">
                            Karın içi organ dolaşımını artıran torsiyonel omurga akışları, bağırsak-beyin aksını rahatlatan vagal stimülasyon teknikleri.
                        </p>
                    </div>
                </div>

                <!-- Hafta 3 -->
                <div class="curriculum-item">
                    <div class="curriculum-num">03</div>
                    <div class="curriculum-body">
                        <span class="curriculum-tag">3. HAFTA</span>
                        <h4 class="curriculum-title">Miyofasyal Ağ &amp; Dinamik Kuvvet</h4>
                        <p class="curriculum-desc">
                            Tüm vücudu saran elastik fasya ağının hidrasyonu, kalça ve omuz açıklığı, dayanıklılığı artıran ritmik güç serileri.
                        </p>
                    </div>
                </div>

                <!-- Hafta 4 -->
                <div class="curriculum-item">
                    <div class="curriculum-num">04</div>
                    <div class="curriculum-body">
                        <span class="curriculum-tag">4. HAFTA</span>
                        <h4 class="curriculum-title">Metabolik Entegrasyon &amp; Kalıcı Alışkanlık</h4>
                        <p class="curriculum-desc">
                            Kamp sonrasında da sürdürülebilir beslenme ve hareket ritminin kurulması, kişiselleştirilmiş longevity rehberi ve mezuniyet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Fiyatlandırma & Kayıt Kartı -->
    <section class="detox-pricing-section" id="kayit">
        <div class="container">
            <div class="detox-pricing-box">
                <div class="pricing-badge">TAM KAPSAMLI CANLI DÖNEM</div>
                <h3 class="pricing-title">4 Haftalık Online Detox &amp; Yoga Kampı</h3>
                <p class="pricing-subtitle">Kontenjan kalitesi için katılımcı sayısı sınırlı tutulmaktadır.</p>

                <div class="pricing-amount">
                    <span class="price-val">4.500 ₺</span>
                    <span class="price-term">/ 4 haftalık program, takip ve arşiv dahil</span>
                </div>

                <div class="pricing-checks-list">
                    <div class="check-row">
                        <span class="check-icon">✓</span>
                        <span>16+ Canlı Seans ve Soru-Cevap Atölyeleri</span>
                    </div>
                    <div class="check-row">
                        <span class="check-icon">✓</span>
                        <span>Fizyoterapist ile Birebir WhatsApp İletişimi &amp; Takip</span>
                    </div>
                    <div class="check-row">
                        <span class="check-icon">✓</span>
                        <span>Aç Kalmadan GLP-1 Doğal Doygunluk Beslenme Rehberi</span>
                    </div>
                    <div class="check-row">
                        <span class="check-icon">✓</span>
                        <span>Kaçıranlar İçin Panelde Ömür Boyu Arşiv Kayıtları</span>
                    </div>
                    <div class="check-row">
                        <span class="check-icon">✓</span>
                        <span>Kişisel Movement Space Öğrenci Paneli Erişimi</span>
                    </div>
                </div>

                <div class="pricing-action-wrap">
                    <a href="<?= url('/checkout/1') ?>" class="btn-pricing-join">
                        KAMPA KATIL &rarr;
                    </a>
                    <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba%20Betina%20Hocam,%204%20Haftal%C4%B1k%20Detox%20Kamp%C4%B1%20kayd%C4%B1%20hakk%C4%B1nda%20konu%C5%9Fmak%20istiyorum." target="_blank" rel="noopener noreferrer" class="btn-pricing-wa">
                        WhatsApp ile Kontenjan Sor
                    </a>
                </div>

                <p class="pricing-guarantee-note">
                    🔒 Güvenli Havale / EFT &amp; Kredi Kartı ile Ödeme İmkanı
                </p>
            </div>
        </div>
    </section>

    <!-- 5. Sıkça Sorulan Sorular -->
    <section class="detox-faq-section">
        <div class="container">
            <div class="section-title-wrap text-center">
                <span class="sub-kicker">MERAK EDİLENLER</span>
                <h2 class="section-heading">Sıkça Sorulan Sorular</h2>
            </div>

            <div class="detox-faq-grid">
                <div class="faq-card">
                    <h4 class="faq-q">Daha önce hiç yoga yapmadım, katılabilir miyim?</h4>
                    <p class="faq-a">Kesinlikle evet. Kamp fizyoterapi temelli tasarlandığı için her egzersizin başlangıç ve ileri varyasyonları sunulur. Amacımız zor hareketler değil, omurganın doğru hizalanmasıdır.</p>
                </div>
                <div class="faq-card">
                    <h4 class="faq-q">Canlı ders saatlerine katılamazsam ne olur?</h4>
                    <p class="faq-a">Hiç sorun değil. Tüm seanslar kaydedilir ve aynı gün kişisel öğrenci alanınıza (Movement Space) yüklenir. Dersleri günün istediğiniz saatinde sınırsız tekrar edebilirsiniz.</p>
                </div>
                <div class="faq-card">
                    <h4 class="faq-q">Beslenme programı aç bırakan bir diyet mi?</h4>
                    <p class="faq-a">Hayır, sıvı detoksu veya kalori kısıtlaması kesinlikle içermez. Doğal lif, sağlıklı yağlar ve proteinlerle kan şekerini dengeleyen, tatlı krizlerini kesen doyurucu tabaklardan oluşur.</p>
                </div>
                <div class="faq-card">
                    <h4 class="faq-q">WhatsApp takibi nasıl işliyor?</h4>
                    <p class="faq-a">Kayıt sonrasında gruba ve Betina Tansuğ'un özel iletişim hattına dahil edilirsiniz. Günlük sorularınızı sorabilir, duruşunuzu video ile danışabilir ve anında geri bildirim alırsınız.</p>
                </div>
            </div>
        </div>
    </section>
</div>

