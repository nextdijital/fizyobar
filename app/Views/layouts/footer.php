    </main>
    <!-- Ana İçerik Sonu -->

    <!-- Global Footer (Brutalist Editorial & Yan Yana Menü Sütunları) -->
    <footer class="site-footer <?= ($isDarkPage ?? false) ? 'footer-dark-theme' : '' ?>">
        <div class="footer-editorial-container">
            <!-- 1. Üst Alan: Sliced / %75'i Görünen Dev Tipografik Marka & Çizgi & Sağ Slogan -->
            <div class="footer-sliced-brand-wrap">
                <div class="footer-sliced-brand-inner">
                    <svg viewBox="0 0 1080 80" class="footer-sliced-svg" preserveAspectRatio="xMinYMin meet" aria-label="FİZYOBAR">
                        <text x="0" y="98" class="footer-svg-brand-text">FİZYOBAR</text>
                        <text x="1080" y="68" text-anchor="end" class="footer-svg-tagline">BODY &#8226; ADAPT &#8226; REFRAME</text>
                    </svg>
                </div>
                <div class="footer-sliced-line"></div>
            </div>

            <!-- 2. Orta Alan: Yan Yana Menü Sütunları (4 Kolon) -->
            <div class="footer-columns-grid">
                <!-- Kolon 1: Marka & Betina Tansuğ -->
                <div class="footer-menu-col footer-col-brand">
                    <span class="footer-col-kicker">WELLNESS EXPERIENCES</span>
                    <h4 class="footer-brand-heading">BY BETINA TANSUĞ</h4>
                    <p class="footer-brand-text">
                        Fizyoterapi temelli hareket bilimi ve yoga disiplinini birleştiren "BAR System" ile longevity odaklı, sürdürülebilir bir yaşam rutini.
                    </p>
                    <div class="footer-location-tag">
                        <span>📍</span>
                        <span><?= __('brand.location') ?> (Hibrit & Global Online)</span>
                    </div>
                </div>

                <!-- Kolon 2: Studio & Programlar -->
                <div class="footer-menu-col">
                    <h5 class="footer-col-title">STUDIO &amp; PROGRAMLAR</h5>
                    <ul class="footer-col-links">
                        <li><a href="<?= url('/studio') ?>">Fizyobar Studio</a></li>
                        <li><a href="<?= url('/programs') ?>">Dönüşüm Programları</a></li>
                        <li><a href="<?= url('/plans') ?>">Beslenme Planları</a></li>
                        <li><a href="<?= url('/guides') ?>">Wellness Rehberleri</a></li>
                        <li><a href="<?= url('/recipes') ?>">Fonksiyonel Tarifler</a></li>
                        <li><a href="<?= url('/events') ?>">Platform &amp; SUP Yoga</a></li>
                    </ul>
                </div>

                <!-- Kolon 3: Kurumsal & Bilgi -->
                <div class="footer-menu-col">
                    <h5 class="footer-col-title">KURUMSAL & YASAL</h5>
                    <ul class="footer-col-links">
                        <li><a href="<?= url('/corporate') ?>">Betina Tansuğ Kimdir?</a></li>
                        <li><a href="<?= url('/corporate') ?>">Kurumsal Wellbeing Çözümleri</a></li>
                        <li><a href="<?= url('/corporate') ?>">Şirket Longevity Atölyeleri</a></li>
                        <li><a href="<?= url('/privacy') ?>"><?= __('legal.privacy_title') ?></a></li>
                        <li><a href="<?= url('/cookies') ?>"><?= __('legal.cookies_title') ?></a></li>
                    </ul>
                </div>

                <!-- Kolon 4: Doğrudan İletişim -->
                <div class="footer-menu-col footer-col-contact">
                    <h5 class="footer-col-title">DOĞRUDAN İLETİŞİM</h5>
                    <ul class="footer-contact-list">
                        <li>
                            <span class="contact-lbl">WhatsApp:</span>
                            <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="contact-val contact-highlight">
                                <?= __('brand.phone_display') ?>
                            </a>
                        </li>
                        <li>
                            <span class="contact-lbl">E-Posta:</span>
                            <a href="mailto:<?= __('brand.email') ?>" class="contact-val">
                                <?= __('brand.email') ?>
                            </a>
                        </li>
                        <li>
                            <span class="contact-lbl">Instagram:</span>
                            <a href="<?= __('brand.instagram_url') ?>" target="_blank" rel="noopener noreferrer" class="contact-val">
                                @<?= __('brand.instagram') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 3. Alt Çubuk: Ortalanmış Telif & Dil Seçici -->
            <div class="footer-bottom-bar">
                <div class="footer-bottom-spacer"></div>
                <div class="footer-bottom-center">
                    <span>© <?= date('Y') ?> FİZYOBAR. Tüm hakları saklıdır.</span>
                </div>
                <div class="footer-bottom-right">
                    <a href="<?= switch_lang_url('tr') ?>" class="lang-switch-link <?= $isTr ? 'active-lang' : '' ?>">TR</a>
                    <span class="footer-sep">/</span>
                    <a href="<?= switch_lang_url('en') ?>" class="lang-switch-link <?= $isEn ? 'active-lang' : '' ?>">EN</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Yapay Zeka AI Asistan Bileşeni (Uçan Balon & Chat Drawer) -->
    <?php require __DIR__ . '/../partials/ai-chat.php'; ?>

    <!-- Çerez Yönetim Bileşeni -->
    <?php require __DIR__ . '/cookie-banner.php'; ?>

    <!-- JS Komut Dosyaları -->
    <script>
        window.Fizyobar = {
            basePath: "<?= e($basePath) ?>",
            currentLang: "<?= e($currentLang) ?>",
            csrfToken: "<?= e($csrfToken) ?>"
        };
    </script>
    <script src="<?= asset('assets/js/cookie-consent.js') ?>" defer></script>
    <script src="<?= asset('assets/js/ai-chat.js') ?>" defer></script>
    <script src="<?= asset('assets/js/app.js') ?>" defer></script>
</body>
</html>
