<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<!-- ==============================================================================
     ORIPIOFIN MODERN DASHBOARD: ÜST BAŞLIK VE KONTROLLER
     ============================================================================== -->
<div class="xp-dash-header">
    <div>
        <h1 class="xp-dash-title">Genel Bakış</h1>
        <p class="xp-dash-subtitle">Finansal akış, öğrenci durumu ve son bildirimler özeti</p>
    </div>
    <div class="xp-dash-actions">
        <div class="xp-pill-dropdown">
            <span>📅 Bu Ay</span>
            <span style="font-size: 0.7rem; color: #94a3b8;">▾</span>
        </div>
        <a href="<?= url('/xpanel') ?>" class="xp-btn-reload" title="Verileri Güncelle">
            <span>🔄</span>
            <span>Yenile</span>
        </a>
    </div>
</div>

<!-- ==============================================================================
     ORIPIOFIN 4'LÜ HERO STAT KARTLARI (ÖNE ÇIKAN YEŞİL VE BEYAZ KARTLAR)
     ============================================================================== -->
<div class="xp-oripio-grid">
    
    <!-- 1. Kart: Toplam Onaylı Ciro (OripioFin Hero Emerald Card) -->
    <div class="xp-oripio-card-dark">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap">💳</div>
                <div>
                    <div class="xp-oripio-label" style="color: #ffffff;">Toplam Onaylı Ciro</div>
                    <div class="xp-oripio-sublabel">Onaylanan tüm ödemeler</div>
                </div>
            </div>
            <div class="xp-oripio-dots" title="Seçenekler">•••</div>
        </div>

        <div class="xp-oripio-body">
            <div class="xp-oripio-metric">
                ₺<?= number_format((float)($stats['total_revenue'] ?? 0), 2, ',', '.') ?>
            </div>
            <span class="xp-oripio-badge">
                <span>↑</span> %100 Aktif
            </span>
        </div>

        <a href="<?= url('/xpanel/enrollments') ?>" class="xp-oripio-footer-link">
            <span>Ödeme kayıtlarını incele</span>
            <span>&rarr;</span>
        </a>
    </div>

    <!-- 2. Kart: Bekleyen IBAN Ödemeleri (White Modern Card) -->
    <div class="xp-oripio-card-white">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #fffbeb; color: #b45309;">⏳</div>
                <div>
                    <div class="xp-oripio-label">Bekleyen Ödemeler</div>
                    <div class="xp-oripio-sublabel">İncelenmesi gereken havaleler</div>
                </div>
            </div>
            <div class="xp-oripio-dots" title="Seçenekler">•••</div>
        </div>

        <div class="xp-oripio-body">
            <div class="xp-oripio-metric" style="color: <?= (int)$stats['pending_enrollments'] > 0 ? '#b45309' : '#0f172a' ?>;">
                <?= (int)$stats['pending_enrollments'] ?>
            </div>
            <?php if ((int)$stats['pending_enrollments'] > 0): ?>
                <span class="xp-oripio-badge xp-oripio-badge-amber">
                    ● Onay Bekliyor
                </span>
            <?php else: ?>
                <span class="xp-oripio-badge xp-oripio-badge-green">
                    ✓ Tamamı Temiz
                </span>
            <?php endif; ?>
        </div>

        <a href="<?= url('/xpanel/enrollments') ?>" class="xp-oripio-footer-link">
            <span>Onay listesini aç</span>
            <span>&rarr;</span>
        </a>
    </div>

    <!-- 3. Kart: Aktif Öğrenci & Üyelikler (White Modern Card) -->
    <div class="xp-oripio-card-white">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #ecfdf5; color: #047857;">👥</div>
                <div>
                    <div class="xp-oripio-label">Aktif Öğrenciler</div>
                    <div class="xp-oripio-sublabel">Erişimi açık üyeler</div>
                </div>
            </div>
            <div class="xp-oripio-dots" title="Seçenekler">•••</div>
        </div>

        <div class="xp-oripio-body">
            <div class="xp-oripio-metric">
                <?= (int)$stats['approved_enrollments'] ?>
            </div>
            <span class="xp-oripio-badge xp-oripio-badge-blue">
                <?= (int)$stats['total_students'] ?> Kayıtlı
            </span>
        </div>

        <a href="<?= url('/xpanel/users') ?>" class="xp-oripio-footer-link">
            <span>Öğrenci ve üye listesi</span>
            <span>&rarr;</span>
        </a>
    </div>

    <!-- 4. Kart: Eğitim Programları & Studio (White Modern Card) -->
    <div class="xp-oripio-card-white">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #fdf2f8; color: #db2777;">🎬</div>
                <div>
                    <div class="xp-oripio-label">Program &amp; İçerik</div>
                    <div class="xp-oripio-sublabel">Yayındaki eğitim ve tarifler</div>
                </div>
            </div>
            <div class="xp-oripio-dots" title="Seçenekler">•••</div>
        </div>

        <div class="xp-oripio-body">
            <div class="xp-oripio-metric">
                <?= (int)($stats['total_courses'] ?? 6) ?>
            </div>
            <span class="xp-oripio-badge xp-oripio-badge-green">
                ● <?= (int)($stats['total_nutrition'] ?? 6) ?> İçerik Yayında
            </span>
        </div>

        <a href="<?= url('/xpanel/courses') ?>" class="xp-oripio-footer-link">
            <span>Programları yönet</span>
            <span>&rarr;</span>
        </a>
    </div>

</div>

<!-- ==============================================================================
     ORIPIOFIN MODERN TABLO: SON ABONELİK & ÖDEME BİLDİRİMLERİ (ID SÜTUNSUZ!)
     ============================================================================== -->
<div class="xp-table-card">
    <div class="xp-table-header-bar">
        <div>
            <h2 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 0.2rem 0; letter-spacing: -0.01em;">
                Son Abonelik &amp; Ödeme Bildirimleri
            </h2>
            <span style="font-size: 0.8rem; color: #64748b;">
                Sisteme iletilen en güncel 10 sipariş ve havale bildirimi
            </span>
        </div>

        <div style="display: flex; align-items: center; gap: 0.65rem;">
            <div class="xp-table-search-box">
                <span style="font-size: 0.85rem; color: #94a3b8;">🔍</span>
                <input type="text" id="recentTableSearch" placeholder="Öğrenci veya program ara..." onkeyup="filterRecentTable(this.value)">
            </div>
            <a href="<?= url('/xpanel/enrollments') ?>" class="xp-table-filter-btn">
                <span>Tümünü Gör</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>

    <?php if (empty($recentEnrollments)): ?>
        <p style="color: #64748b; font-size: 0.9rem; text-align: center; padding: 2.5rem 0;">
            Henüz bir ödeme kaydı bulunmuyor.
        </p>
    <?php else: ?>
        <div class="xpanel-table-wrap">
            <table class="xpanel-table" id="recentEnrollmentsTable">
                <thead>
                    <tr>
                        <th style="width: 36px; text-align: center;">
                            <input type="checkbox" class="xp-check-cell" title="Tümünü seç">
                        </th>
                        <th style="min-width: 170px;">Öğrenci Bilgisi</th>
                        <th style="min-width: 180px;">Program</th>
                        <th style="width: 100px;">Ödeme Yöntemi</th>
                        <th style="width: 110px;">Tutar</th>
                        <th style="width: 130px;">Durum</th>
                        <th style="width: 120px; white-space: nowrap;">Tarih &amp; Saat</th>
                        <th style="width: 80px; text-align: right; white-space: nowrap;">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentEnrollments as $r): 
                        $initial = mb_strtoupper(mb_substr(trim($r['user_name'] ?? 'Ö'), 0, 1));
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <input type="checkbox" class="xp-check-cell">
                            </td>
                            <td>
                                <div class="xp-user-cell">
                                    <div class="xp-avatar-circle avatar-brand">
                                        <?= e($initial) ?>
                                    </div>
                                    <div>
                                        <div class="xp-user-cell-name"><?= e($r['user_name']) ?></div>
                                        <div class="xp-user-cell-meta"><?= e($r['user_email']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; font-size: 0.84rem; color: #0f172a; line-height: 1.35; max-width: 260px;">
                                    <?= e($r['course_title']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="xp-method-pill">
                                    <?= e($r['payment_method']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="xp-amount-val">
                                    ₺<?= number_format((float)$r['amount'], 2, ',', '.') ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($r['payment_status'] === 'approved'): ?>
                                    <span class="xp-status-dot-pill xp-status-dot-approved">
                                        <span class="dot"></span> Onaylandı
                                    </span>
                                <?php elseif ($r['payment_status'] === 'pending'): ?>
                                    <span class="xp-status-dot-pill xp-status-dot-pending">
                                        <span class="dot"></span> Onay Bekliyor
                                    </span>
                                <?php else: ?>
                                    <span class="xp-status-dot-pill xp-status-dot-rejected">
                                        <span class="dot"></span> Reddedildi
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="xp-date-primary"><?= date('d.m.Y', strtotime($r['created_at'])) ?></div>
                                <div class="xp-date-sub"><?= date('H:i', strtotime($r['created_at'])) ?></div>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <?php if ($r['payment_status'] === 'pending'): ?>
                                    <form action="<?= url('/xpanel/enrollments/approve') ?>" method="POST" style="display: inline; margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-approve">✓ Onayla</button>
                                    </form>
                                <?php else: ?>
                                    <span class="xp-more-dots" title="Detay">•••</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script>
function filterRecentTable(val) {
    const filter = val.toLowerCase();
    const rows = document.querySelectorAll('#recentEnrollmentsTable tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>
