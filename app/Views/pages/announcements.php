<?php
declare(strict_types=1);
?>

<!-- Duyurular Hero -->
<section class="page-editorial-hero">
    <div class="container text-center">
        <span class="section-kicker">GÜNCEL GELİŞMELER</span>
        <h1 class="page-editorial-title">Duyurular &amp; Kamp Kayıtları</h1>
        <p class="page-editorial-lead">
            Fizyobar yeni dönem online kampları, canlı atölyeler, stüdyo etkinlikleri ve kayıt takvimi.
        </p>
    </div>
</section>

<!-- Duyurular Listesi -->
<section style="padding: clamp(3rem, 5vw, 5rem) 0;">
    <div class="container" style="max-width: 900px;">
        <div style="display: flex; flex-direction: column; gap: 1.75rem;">
            
            <!-- Duyuru 1 -->
            <article class="event-card event-card-featured" style="padding: 2rem;">
                <div class="event-card-header" style="margin-bottom: 0.75rem;">
                    <span class="event-badge badge-bordo">YENİ DÖNEM KAYITLARI AÇIK</span>
                    <span class="event-loc">ONLİNE CANLI</span>
                </div>
                <h3 class="event-title" style="font-size: 1.45rem; margin-bottom: 0.5rem;">4 Haftalık Online Canlı Yoga &amp; Metabolik Detox Kampı</h3>
                <p class="event-desc" style="font-size: 0.95rem; line-height: 1.7; margin-bottom: 1.25rem;">
                    Yeni dönem kontenjanları açıldı. Haftada 3 canlı yoga ve postür seansı, günlük WhatsApp eğitmen takibi, rafine şekersiz glisemik beslenme rehberi ve GLP-1 tokluk yönetimi dahil.
                </p>
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; border-top: 1px solid #f0f0f0; padding-top: 1rem;">
                    <span style="font-size: 0.84rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.08em;">BAŞLANGIÇ: YAKINDA • KONTENJAN: SINIRLI</span>
                    <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-pill-solid" style="padding: 0.55rem 1.4rem; font-size: 0.76rem;">
                        HEMEN KAYDOL &rarr;
                    </a>
                </div>
            </article>

            <!-- Duyuru 2 -->
            <article class="event-card" style="padding: 2rem;">
                <div class="event-card-header" style="margin-bottom: 0.75rem;">
                    <span class="event-badge">WORKSHOP &amp; ATÖLYE</span>
                    <span class="event-loc">ADANA GÜLEK PLAZA</span>
                </div>
                <h3 class="event-title" style="font-size: 1.35rem; margin-bottom: 0.5rem;">Fasya Sağlığı &amp; Foam Roller Derin Doku Atölyesi</h3>
                <p class="event-desc" style="font-size: 0.92rem; line-height: 1.7; margin-bottom: 1.25rem;">
                    Kronik boyun, bel ve kalça gerginliklerini hafifletmek için fasya hidrasyonu ve myofasyal gevşeme tekniklerini öğreneceğimiz yüz yüze mini çalıştay.
                </p>
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; border-top: 1px solid #f0f0f0; padding-top: 1rem;">
                    <span style="font-size: 0.84rem; font-weight: 600; color: #737373;">KONTENJAN: 12 KİŞİ</span>
                    <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-pill-outline-dark" style="padding: 0.55rem 1.4rem; font-size: 0.76rem;">
                        BİLGİ AL &rarr;
                    </a>
                </div>
            </article>

            <!-- Duyuru 3 -->
            <article class="event-card" style="padding: 2rem;">
                <div class="event-card-header" style="margin-bottom: 0.75rem;">
                    <span class="event-badge">STUDİO GÜNCELLEMESİ</span>
                    <span class="event-loc">DİJİTAL KÜTÜPHANE</span>
                </div>
                <h3 class="event-title" style="font-size: 1.35rem; margin-bottom: 0.5rem;">Fizyobar Studio Yeni Fonksiyonel Tarifler &amp; Rehberler Yayında</h3>
                <p class="event-desc" style="font-size: 0.92rem; line-height: 1.7; margin-bottom: 1.25rem;">
                    Anti-enflamatuar altın smoothie'ler, glisemik dengeli chia pudingler ve servikal omurga mobilite serileri dijital stüdyo üyelerine açıldı.
                </p>
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; border-top: 1px solid #f0f0f0; padding-top: 1rem;">
                    <span style="font-size: 0.84rem; font-weight: 600; color: #737373;">TÜM ÜYELERE AÇIK</span>
                    <a href="<?= url('/studio') ?>" class="btn-pill-outline-dark" style="padding: 0.55rem 1.4rem; font-size: 0.76rem;">
                        STUDIO'YU İNCELE &rarr;
                    </a>
                </div>
            </article>

        </div>
    </div>
</section>

