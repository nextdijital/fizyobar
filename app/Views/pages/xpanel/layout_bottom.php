        </main><!-- /.xp-content-area -->

        <footer style="background-color: var(--xp-surface); border-top: 1px solid var(--xp-border); padding: 1rem 1.75rem; font-size: 0.78rem; color: var(--xp-text-muted); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem; box-sizing: border-box;">
            <span>FİZYOBAR Yönetim v2.0 &bull; Güvenli Yönetici Paneli</span>
            <span>PHP <?= PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION ?> &bull; UTF-8</span>
        </footer>
    </div><!-- /.xp-main-wrapper -->

    <!-- =========================================================================
         MOBİL DRAWER, MODAL VE AKORDİYON MENÜ İNTERAKTİF SCRİPTLERİ
         ========================================================================= -->
    <script>
    function toggleNavGroup(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.toggle('is-open');
        try {
            localStorage.setItem('sidebar_' + id, el.classList.contains('is-open') ? 'open' : 'closed');
        } catch(e) {}
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Akordiyon durumunu hatırla (aktif sayfa grubu haricindekileri kullanıcının seçtiği gibi koru)
        ['navGroupPages', 'navGroupCrm'].forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            try {
                const saved = localStorage.getItem('sidebar_' + id);
                if (saved === 'open') {
                    el.classList.add('is-open');
                } else if (saved === 'closed' && !el.querySelector('.active')) {
                    el.classList.remove('is-open');
                }
            } catch(e) {}
        });

        const hamburgerBtn = document.getElementById('xpHamburgerBtn');
        const sidebar = document.getElementById('xpSidebar');
        const sidebarOverlay = document.getElementById('xpSidebarOverlay');
        const sidebarClose = document.getElementById('xpSidebarClose');

        function openSidebar() {
            if (sidebar) sidebar.classList.add('is-open');
            if (sidebarOverlay) sidebarOverlay.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            if (sidebar) sidebar.classList.remove('is-open');
            if (sidebarOverlay) sidebarOverlay.classList.remove('is-active');
            document.body.style.overflow = '';
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener('click', openSidebar);
        if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

        // ESC tuşu ile modal veya sidebar kapatma
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSidebar();
                document.querySelectorAll('.xp-modal-backdrop').forEach(m => m.style.display = 'none');
            }
        });
    });
    </script>
</body>
</html>
