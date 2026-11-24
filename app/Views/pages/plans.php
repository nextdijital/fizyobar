<?php
declare(strict_types=1);
?>

<div class="fzy-sage-plans-page">
    
    <!-- Tüm Sayfanın Sabit Dev Tipografi Arka Planı -->
    <div class="sage-giant-backdrop" aria-hidden="true">
        <div class="giant-marquee-row row-1">
            <span>DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • </span>
            <span>DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • </span>
        </div>
        <div class="giant-marquee-row row-2">
            <span>BESLENME PLANLARI • FİZYOBAR NUTRITION • METABOLİK RESET • SAĞLIKLI YAŞAM PROTOKOLÜ • </span>
            <span>BESLENME PLANLARI • FİZYOBAR NUTRITION • METABOLİK RESET • SAĞLIKLI YAŞAM PROTOKOLÜ • </span>
        </div>
        <div class="giant-marquee-row row-3">
            <span>DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • </span>
            <span>DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • DERSLERİMİZİ KEŞFEDİN • PROGRAMLARIMIZI KEŞFEDİN • </span>
        </div>
        <div class="giant-marquee-row row-4">
            <span>FONKSİYONEL BESLENME • GLİSEMİK DENGE • ANTI-ENFLAMATUAR YAŞAM • FİZYOBAR • </span>
            <span>FONKSİYONEL BESLENME • GLİSEMİK DENGE • ANTI-ENFLAMATUAR YAŞAM • FİZYOBAR • </span>
        </div>
    </div>

    <!-- 1. Dev Tipografik Arka Plan & Sabit / Kaydırmalı Kartlar Alanı (Referans Ekran Görüntüsü) -->
    <section class="sage-hero-stage" id="sageHeroStage">
        
        <!-- Ön Plandaki 3 Büyük Yuvarlak Hatlı Görsel Kartı (Pilates, Yoga, Meditate Stili) -->
        <div class="sage-cards-stage-wrap">
            <div class="sage-cards-row" id="sageCardsRow">
                
                <!-- Kart 1: Pilates / Detox -->
                <div class="sage-art-card card-1" onclick="SagePlans.openDetail(1)">
                    <div class="sage-card-media">
                        <img src="<?= asset('assets/images/guides/guide-01.jpg') ?>" alt="Pilates & Detox Planı" class="sage-card-img">
                        <div class="sage-card-gradient"></div>
                        <div class="sage-card-script-title">Pilates</div>
                        <div class="sage-card-overlay-info">
                            <span class="card-pill-tag">DETOX PROTOKOLÜ</span>
                            <h3 class="card-title-text">Metabolik Reset Kampı</h3>
                            <p class="card-desc-text">Rafine şekersiz, glisemik dengeli ve hücresel arınma protokolü.</p>
                            <span class="card-action-link">Detayları İncele &rarr;</span>
                        </div>
                    </div>
                </div>

                <!-- Kart 2: Yoga / Glutensiz -->
                <div class="sage-art-card card-2" onclick="SagePlans.openDetail(2)">
                    <div class="sage-card-media">
                        <img src="<?= asset('assets/images/guides/guide-02.jpg') ?>" alt="Yoga & Anti-Enflamatuar" class="sage-card-img">
                        <div class="sage-card-gradient"></div>
                        <div class="sage-card-script-title">Yoga</div>
                        <div class="sage-card-overlay-info">
                            <span class="card-pill-tag">ANTİ-ENFLAMATUAR</span>
                            <h3 class="card-title-text">Glutensiz & Prebiyotik Yaşam</h3>
                            <p class="card-desc-text">Bağırsak mikrobiyotasını onaran ve enerjiyi yükselten beslenme şablonu.</p>
                            <span class="card-action-link">Detayları İncele &rarr;</span>
                        </div>
                    </div>
                </div>

                <!-- Kart 3: Meditate / Bireysel -->
                <div class="sage-art-card card-3" onclick="SagePlans.openDetail(3)">
                    <div class="sage-card-media">
                        <img src="<?= asset('assets/images/guides/guide-04.jpg') ?>" alt="Meditate & Bireysel Danışmanlık" class="sage-card-img">
                        <div class="sage-card-gradient"></div>
                        <div class="sage-card-script-title">Meditate</div>
                        <div class="sage-card-overlay-info">
                            <span class="card-pill-tag">BİREBİR ANAMNEZ</span>
                            <h3 class="card-title-text">Kişiye Özel Beslenme</h3>
                            <p class="card-desc-text">Kan tahlili ve omurga sağlığınıza özel bireysel menü dizaynı.</p>
                            <span class="card-action-link">Detayları İncele &rarr;</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Alt Merkez Buton (Dersleri Keşfedin) -->
            <div class="sage-bottom-action">
                <a href="#plansDetailSection" class="sage-explore-pill-btn" onclick="SagePlans.scrollToDetail(event)">
                    <span>DERSLERİMİZİ KEŞFEDİN</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
            </div>
        </div>

    </section>

    <!-- 2. Aşağı Kaydırıldığında Görünen Detaylı Protokol Açıklamaları -->
    <section class="sage-details-section" id="plansDetailSection">
        <div class="container">
            
            <div class="details-section-heading text-center">
                <span class="details-kicker">FİZYOBAR NUTRITION • HÜCRESEL PROTOKOLLER</span>
                <h2 class="details-title">Hedefinize En Uygun Beslenme Yolculuğu</h2>
                <p class="details-lead">Bedeninizi aç bırakmadan, kan şekerini sabitleyerek ve doku enflamasyonunu sıfırlayarak kalıcı canlılık inşa edin.</p>
            </div>

            <div class="sage-protocols-grid">
                
                <!-- Protokol 1 Detayı -->
                <div class="protocol-detail-card" id="detail-card-1">
                    <div class="protocol-card-header">
                        <span class="protocol-badge-pill">★ EN ÇOK TERCİH EDİLEN</span>
                        <h3 class="protocol-card-title">4 Haftalık Metabolik Reset & Detox Kampı</h3>
                        <p class="protocol-card-subtitle">İnteraktif Online Kamp • Günlük WhatsApp Takibi</p>
                    </div>
                    <div class="protocol-card-body">
                        <p class="protocol-desc">Rafine şekeri ve enflamatuar yağları sistemden temizleyerek insülin hassasiyetini ve sindirim dengesini sıfırdan kuran bütünsel plan.</p>
                        <ul class="protocol-checklist">
                            <li><span class="check-icon">✓</span><span>Haftalık Glisemik Dengeli Alışveriş Listeleri</span></li>
                            <li><span class="check-icon">✓</span><span>30+ Rafine Şekersiz & Hızlı Pratik Tarif</span></li>
                            <li><span class="check-icon">✓</span><span>Fizyoterapist Betina Tansuğ Eşliğinde Günlük WhatsApp Takibi</span></li>
                            <li><span class="check-icon">✓</span><span>Diyafram Nefesi ile Sindirim Sistemi (Agni) Uyarımı</span></li>
                            <li><span class="check-icon">✓</span><span>Ömür Boyu Saklanabilir Dijital E-Kitap Kılavuzu</span></li>
                        </ul>
                    </div>
                    <div class="protocol-card-footer">
                        <a href="<?= url('/detox') ?>" class="protocol-cta-btn btn-primary-dark">
                            <span>KAMPA KATIL & PLANI AL</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Protokol 2 Detayı -->
                <div class="protocol-detail-card" id="detail-card-2">
                    <div class="protocol-card-header">
                        <span class="protocol-badge-pill">🌱 SÜRDÜRÜLEBİLİR YAŞAM</span>
                        <h3 class="protocol-card-title">Glutensiz & Anti-Enflamatuar Yaşam</h3>
                        <p class="protocol-card-subtitle">Ömür Boyu Yaşam Biçimi • Bağırsak Mikrobiyotası</p>
                    </div>
                    <div class="protocol-card-body">
                        <p class="protocol-desc">Mide-bağırsak şişkinliklerini gideren, eklem ve fasya yangısını dindiren, hücresel enerjiyi yükselten dengeli şablon.</p>
                        <ul class="protocol-checklist">
                            <li><span class="check-icon">✓</span><span>Bağırsak Mikrobiyotasını Besleyen Prebiyotik Menüler</span></li>
                            <li><span class="check-icon">✓</span><span>Ev Yapımı Glutensiz Ekmek & Pratik Atıştırmalıklar</span></li>
                            <li><span class="check-icon">✓</span><span>Restoranlarda ve Sosyal Yaşamda Kolay Uygulama Stratejileri</span></li>
                            <li><span class="check-icon">✓</span><span>Mitokondriyal Hücresel Longevity İpuçları</span></li>
                            <li><span class="check-icon">✓</span><span>Mevsimsel Sebze ve Kaliteli Yağ Kombinasyonları</span></li>
                        </ul>
                    </div>
                    <div class="protocol-card-footer">
                        <a href="https://wa.me/905357056828?text=<?= rawurlencode('Merhaba Betina Hocam, Glutensiz & Anti-Enflamatuar Beslenme Planı hakkında bilgi almak istiyorum.') ?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="protocol-cta-btn btn-outline-dark">
                            <span>WHATSAPP İLE BİLGİ AL</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Protokol 3 Detayı -->
                <div class="protocol-detail-card" id="detail-card-3">
                    <div class="protocol-card-header">
                        <span class="protocol-badge-pill">✨ BİREBİR ANALİZ</span>
                        <h3 class="protocol-card-title">Bireysel Anamnez & Beslenme Danışmanlığı</h3>
                        <p class="protocol-card-subtitle">Kişiye Özel Kurgu • Doğrudan Betina Tansuğ</p>
                    </div>
                    <div class="protocol-card-body">
                        <p class="protocol-desc">Kan tahlilleriniz, yaşam temponuz, stres düzeyiniz ve omurga sağlığınız analiz edilerek tamamen size özel kurgulanan birebir seans.</p>
                        <ul class="protocol-checklist">
                            <li><span class="check-icon">✓</span><span>Kapsamlı Fonksiyonel Anamnez & Alışkanlık Taraması</span></li>
                            <li><span class="check-icon">✓</span><span>İş ve Seyahat Temponuza Uyumlu Kişisel Tabak Dizaynı</span></li>
                            <li><span class="check-icon">✓</span><span>Vagus Siniri Regülasyonu ile Duygusal Yeme Kontrolü</span></li>
                            <li><span class="check-icon">✓</span><span>2 Haftalık Geri Bildirim ve Biyometrik Revizyon</span></li>
                            <li><span class="check-icon">✓</span><span>Fizyoterapist ile Birebir WhatsApp Görüşmeleri</span></li>
                        </ul>
                    </div>
                    <div class="protocol-card-footer">
                        <a href="https://wa.me/905357056828?text=<?= rawurlencode('Merhaba Betina Hocam, Bireysel Fonksiyonel Beslenme Danışmanlığı hakkında bilgi almak ve randevu planlamak istiyorum.') ?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="protocol-cta-btn btn-outline-dark">
                            <span>BETİNA HOCA İLE GÖRÜŞ</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Alt Yapay Zeka Testi Kartı -->
            <div class="sage-ai-card">
                <div class="sage-ai-inner">
                    <span class="ai-spark-tag">✨ HANGİ PLANA İHTİYACIN VAR?</span>
                    <h3 class="ai-title">1 Dakikalık Fizyobar Testini Çöz</h3>
                    <p class="ai-desc">Sindirim yapınıza, günlük hareket temponuza ve hedeflerinize en uygun beslenme yol haritasını anında öğrenin.</p>
                    <a href="<?= url('/programini-bul') ?>" class="ai-cta-pill">
                        <span>TESTİ HEMEN BAŞLAT</span>
                        <span class="ai-icon">✨</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

</div>

<script>
const SagePlans = (function() {
    function scrollToDetail(e) {
        if (e) e.preventDefault();
        const target = document.getElementById('plansDetailSection');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function openDetail(cardId) {
        const target = document.getElementById('detail-card-' + cardId);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
            target.classList.add('is-highlighted');
            setTimeout(() => target.classList.remove('is-highlighted'), 1800);
        }
    }

    // Kartlar için fare ile yatay kaydırma ve parmakla swipe
    document.addEventListener('DOMContentLoaded', () => {
        const row = document.getElementById('sageCardsRow');
        if (!row) return;

        let isDown = false;
        let startX;
        let scrollLeft;

        row.addEventListener('mousedown', (e) => {
            isDown = true;
            row.classList.add('is-dragging');
            startX = e.pageX - row.offsetLeft;
            scrollLeft = row.scrollLeft;
        });

        row.addEventListener('mouseleave', () => {
            isDown = false;
            row.classList.remove('is-dragging');
        });

        row.addEventListener('mouseup', () => {
            isDown = false;
            row.classList.remove('is-dragging');
        });

        row.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - row.offsetLeft;
            const walk = (x - startX) * 1.5;
            row.scrollLeft = scrollLeft - walk;
        });
    });

    return { scrollToDetail, openDetail };
})();

window.SagePlans = SagePlans;
</script>
