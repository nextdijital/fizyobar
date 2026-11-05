/**
 * Fizyobar - KVKK & GDPR Çerez Yönetim Motoru
 * Kullanıcı tercihlerini yerel ve sunucu taraflı güvenle yönetir.
 */
(function() {
    'use strict';

    const COOKIE_NAME = 'fizyo_cookie_consent';
    const banner = document.getElementById('cookieBanner');
    const modal = document.getElementById('cookieModal');
    
    const btnAcceptAll = document.getElementById('cookieAcceptAll');
    const btnRejectNonEssential = document.getElementById('cookieRejectNonEssential');
    const btnOpenPreferences = document.getElementById('cookieOpenPreferences');
    const btnCloseModal = document.getElementById('cookieModalClose');
    const btnSaveCustom = document.getElementById('cookieSaveCustom');

    const footerManageBtn = document.getElementById('footerManageCookies');
    const inPageManageBtn = document.getElementById('inPageManageCookies');

    const prefAnalytics = document.getElementById('prefAnalytics');
    const prefMarketing = document.getElementById('prefMarketing');

    function getCookie(name) {
        const matches = document.cookie.match(new RegExp(
            '(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)'
        ));
        return matches ? decodeURIComponent(matches[1]) : null;
    }

    function setLocalCookie(name, value, days) {
        let expires = '';
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + encodeURIComponent(value) + expires + '; path=/; SameSite=Lax';
    }

    function saveConsent(preferences) {
        const jsonStr = JSON.stringify(preferences);
        setLocalCookie(COOKIE_NAME, jsonStr, 365);

        // Sunucuya güvenli POST bildirimi
        const csrfToken = window.Fizyobar ? window.Fizyobar.csrfToken : '';
        const basePath = window.Fizyobar ? window.Fizyobar.basePath : '';

        fetch((basePath || '') + '/api/cookie-preferences', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: jsonStr
        }).catch(() => {
            // Sessizce geç; yerel çerez zaten kaydedildi
        });

        if (banner) banner.style.display = 'none';
        if (modal) modal.style.display = 'none';

        // Diğer izleme betikleri için olay tetikle
        window.dispatchEvent(new CustomEvent('fizyo:consentUpdated', { detail: preferences }));
    }

    function checkConsent() {
        const consentCookie = getCookie(COOKIE_NAME);
        if (!consentCookie) {
            if (banner) banner.style.display = 'block';
        } else {
            try {
                const prefs = JSON.parse(consentCookie);
                if (prefAnalytics) prefAnalytics.checked = !!prefs.analytics;
                if (prefMarketing) prefMarketing.checked = !!prefs.marketing;
            } catch (e) {
                if (banner) banner.style.display = 'block';
            }
        }
    }

    function openModal() {
        const consentCookie = getCookie(COOKIE_NAME);
        if (consentCookie) {
            try {
                const prefs = JSON.parse(consentCookie);
                if (prefAnalytics) prefAnalytics.checked = !!prefs.analytics;
                if (prefMarketing) prefMarketing.checked = !!prefs.marketing;
            } catch (e) {}
        }
        if (modal) modal.style.display = 'flex';
    }

    function closeModal() {
        if (modal) modal.style.display = 'none';
    }

    // Olay Dinleyicileri
    if (btnAcceptAll) {
        btnAcceptAll.addEventListener('click', function() {
            saveConsent({ necessary: true, analytics: true, marketing: true, timestamp: Date.now() });
        });
    }

    if (btnRejectNonEssential) {
        btnRejectNonEssential.addEventListener('click', function() {
            saveConsent({ necessary: true, analytics: false, marketing: false, timestamp: Date.now() });
        });
    }

    if (btnOpenPreferences) {
        btnOpenPreferences.addEventListener('click', openModal);
    }

    if (btnCloseModal) {
        btnCloseModal.addEventListener('click', closeModal);
    }

    if (footerManageBtn) {
        footerManageBtn.addEventListener('click', openModal);
    }

    if (inPageManageBtn) {
        inPageManageBtn.addEventListener('click', openModal);
    }

    if (btnSaveCustom) {
        btnSaveCustom.addEventListener('click', function() {
            const preferences = {
                necessary: true,
                analytics: prefAnalytics ? prefAnalytics.checked : false,
                marketing: prefMarketing ? prefMarketing.checked : false,
                timestamp: Date.now()
            };
            saveConsent(preferences);
        });
    }

    // Modal dışına tıklandığında kapatma
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }

    // Sayfa yüklendiğinde başlat
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkConsent);
    } else {
        checkConsent();
    }
})();

