<?php
declare(strict_types=1);
?>

<!-- Programlar Sayfası Hero -->
<section class="page-editorial-hero">
    <div class="container text-center">
        <span class="section-kicker">EĞİTİMLER & CANLI KAMPLAR</span>
        <h1 class="page-editorial-title">Dönüşüm Programları</h1>
        <p class="page-editorial-lead">
            Fizyoterapist Betina Tansuğ rehberliğinde bedeninize, günlük temponuza ve hedeflerinize uygun bilimsel pratikler. Canlı seanslar, kayıt arşivi ve birebir eğitmen desteği.
        </p>

        <!-- Kategori Filtreleri -->
        <div class="programs-filter-bar">
            <button type="button" class="prog-filter-btn active" data-filter="all">TÜM PROGRAMLAR</button>
            <button type="button" class="prog-filter-btn" data-filter="online">ONLINE CANLI KAMP</button>
            <button type="button" class="prog-filter-btn" data-filter="studio">STÜDYO & ATÖLYE</button>
            <button type="button" class="prog-filter-btn" data-filter="sup">PLATFORM & SUP YOGA</button>
        </div>
    </div>
</section>

<!-- Program Kartları Izgarası -->
<section class="programs-catalog-section">
    <div class="container">
        <div class="programs-editorial-grid">
            <?php foreach ($courses as $c): ?>
                <article class="prog-card" data-category="<?= e($c['category']) ?>">
                    <div class="prog-card-top">
                        <span class="prog-badge-format">
                            <?= strtoupper(e($c['category'])) ?> • <?= (int)$c['duration_weeks'] ?> HAFTA
                        </span>
                        <span class="prog-badge-status">YENİ DÖNEM</span>
                    </div>

                    <div class="prog-card-content">
                        <h2 class="prog-card-title"><?= e($c['title']) ?></h2>
                        <p class="prog-card-subtitle"><?= e($c['subtitle']) ?></p>

                        <div class="prog-highlights-list">
                            <div class="prog-highlight-item">
                                <span class="highlight-bullet">•</span>
                                <span>Haftalık Canlı Akışlar & Soru-Cevap</span>
                            </div>
                            <div class="prog-highlight-item">
                                <span class="highlight-bullet">•</span>
                                <span>Ömür Boyu / Dönem Boyu Video Kayıt Erişimi</span>
                            </div>
                            <div class="prog-highlight-item">
                                <span class="highlight-bullet">•</span>
                                <span>Özel WhatsApp Topluluğu & Beslenme Rehberi</span>
                            </div>
                        </div>
                    </div>

                    <div class="prog-card-footer">
                        <div class="prog-price-box">
                            <span class="prog-price-label">Program Yatırımı</span>
                            <div class="prog-price-num">₺<?= number_format((float)$c['price'], 0, ',', '.') ?></div>
                        </div>

                        <div class="prog-cta-box">
                            <a href="<?= url('/checkout/' . $c['id']) ?>" class="btn-pill-solid">
                                HEMEN KATIL &rarr;
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- Ek Tanıtım Kartı: Platform & SUP Yoga -->
            <article class="prog-card prog-card-custom" data-category="sup">
                <div class="prog-card-top">
                    <span class="prog-badge-format">AÇIK HAVA • SU ÜZERİNDE</span>
                    <span class="prog-badge-status">SEZONLUK</span>
                </div>

                <div class="prog-card-content">
                    <h2 class="prog-card-title">Platform & SUP Yoga Seansları</h2>
                    <p class="prog-card-subtitle">
                        Adana Seyhan Gölü üzerinde özel denge platformlarında, doğayla bütünleşen ve derin merkez gücünü aktive eden açık hava deneyimi.
                    </p>

                    <div class="prog-highlights-list">
                        <div class="prog-highlight-item">
                            <span class="highlight-bullet">•</span>
                            <span>Maksimum Core & Propriyosepsiyon Gelişimi</span>
                        </div>
                        <div class="prog-highlight-item">
                            <span class="highlight-bullet">•</span>
                            <span>Doğa & Suyla Bütünleşen Zihinsel Dinginlik</span>
                        </div>
                        <div class="prog-highlight-item">
                            <span class="highlight-bullet">•</span>
                            <span>Tüm Seviyelere Uygun Güvenli Ekipman</span>
                        </div>
                    </div>
                </div>

                <div class="prog-card-footer">
                    <div class="prog-price-box">
                        <span class="prog-price-label">Grup / Bireysel</span>
                        <div class="prog-price-num">Özel Seans</div>
                    </div>

                    <div class="prog-cta-box">
                        <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20Platform%20ve%20SUP%20Yoga%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." 
                           target="_blank" rel="noopener noreferrer" 
                           class="btn-pill-outline-dark">
                            BİLGİ AL &rarr;
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Güven & Destek Kutusu -->
        <div class="programs-guarantee-banner">
            <div class="guarantee-icon">✦</div>
            <div class="guarantee-text">
                <strong>Hangi programın size uygun olduğundan emin değil misiniz?</strong>
                <p>Mevcut postür durumunuz, eklem hassasiyetleriniz ve hedeflerinize en uygun programı belirlemek için WhatsApp üzerinden doğrudan Betina Tansuğ ile iletişime geçebilirsiniz.</p>
            </div>
            <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-pill-solid-dark">
                DANIŞMANLIK AL
            </a>
        </div>
    </div>
</section>
