<?php
declare(strict_types=1);
?>
<!-- Çerez Kabul / Reddet / Yönetim Bileşeni (KVKK & GDPR Tam Uyumlu) -->
<div id="cookieBanner" class="cookie-banner" role="region" aria-label="<?= __('cookie.title') ?>" style="display: none;">
    <div class="cookie-container">
        <div class="cookie-content">
            <div class="cookie-icon">🍪</div>
            <div class="cookie-text">
                <h4 class="cookie-heading"><?= __('cookie.title') ?></h4>
                <p class="cookie-desc">
                    <?= __('cookie.description') ?>
                    <a href="<?= url('/cookies') ?>" class="cookie-policy-link"><?= __('cookie.policy_link') ?> &rarr;</a>
                </p>
            </div>
        </div>
        <div class="cookie-actions">
            <button type="button" id="cookieAcceptAll" class="btn btn-primary btn-cookie"><?= __('cookie.accept_all') ?></button>
            <button type="button" id="cookieRejectNonEssential" class="btn btn-outline btn-cookie"><?= __('cookie.reject_non_essential') ?></button>
            <button type="button" id="cookieOpenPreferences" class="btn btn-ghost btn-cookie"><?= __('cookie.customize') ?></button>
        </div>
    </div>
</div>

<!-- Çerez Tercihleri Detaylı Modal Penceresi -->
<div id="cookieModal" class="cookie-modal-backdrop" aria-hidden="true" style="display: none;">
    <div class="cookie-modal" role="dialog" aria-labelledby="modalTitle" aria-modal="true">
        <div class="cookie-modal-header">
            <h3 id="modalTitle" class="cookie-modal-title"><?= __('cookie.customize') ?></h3>
            <button type="button" id="cookieModalClose" class="cookie-close-btn" aria-label="<?= __('cookie.close') ?>">&times;</button>
        </div>
        
        <div class="cookie-modal-body">
            <!-- Zorunlu Çerezler -->
            <div class="cookie-preference-item">
                <div class="cookie-pref-info">
                    <h4><?= __('cookie.necessary_title') ?> <span class="badge badge-success"><?= __('cookie.always_active') ?></span></h4>
                    <p><?= __('cookie.necessary_desc') ?></p>
                </div>
                <div class="cookie-pref-toggle">
                    <input type="checkbox" id="prefNecessary" checked disabled aria-label="<?= __('cookie.necessary_title') ?>">
                    <label for="prefNecessary" class="switch-disabled"></label>
                </div>
            </div>

            <!-- Analitik Çerezler -->
            <div class="cookie-preference-item">
                <div class="cookie-pref-info">
                    <h4><?= __('cookie.analytics_title') ?></h4>
                    <p><?= __('cookie.analytics_desc') ?></p>
                </div>
                <div class="cookie-pref-toggle">
                    <label class="switch">
                        <input type="checkbox" id="prefAnalytics">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <!-- Pazarlama Çerezleri -->
            <div class="cookie-preference-item">
                <div class="cookie-pref-info">
                    <h4><?= __('cookie.marketing_title') ?></h4>
                    <p><?= __('cookie.marketing_desc') ?></p>
                </div>
                <div class="cookie-pref-toggle">
                    <label class="switch">
                        <input type="checkbox" id="prefMarketing">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="cookie-modal-footer">
            <button type="button" id="cookieSaveCustom" class="btn btn-primary"><?= __('cookie.save_preferences') ?></button>
        </div>
    </div>
</div>

