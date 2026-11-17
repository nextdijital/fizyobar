<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$activeCount = count(array_filter($items, fn($i) => (int)$i['is_active'] === 1));
$totalCount = count($items);
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 500; color: var(--xp-text); text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">
            Duyurular &amp; Bülten Yönetim Merkezi
        </h1>
        <p style="color: var(--xp-text-muted); font-size: 0.88rem; margin: 0;">
            Ön yüzdeki <code>/duyurular</code> sayfasında listelenen tüm kampları, atölyeleri ve canlı bildiri kartlarını yönetin.
        </p>
    </div>

    <div style="display: flex; gap: 0.75rem;">
        <a href="<?= url('/duyurular') ?>" target="_blank" class="xp-btn-pill-outline" title="Ön yüz duyurular sayfasını yeni sekmede gör">
            <span>Canlı Duyuruları Gör</span>
            <span>↗</span>
        </a>
        <button type="button" onclick="openNewAnnouncementModal()" class="xp-btn-pill-primary">
            + YENİ BİLDİRİ / DUYURU EKLE &rarr;
        </button>
    </div>
</div>

<!-- Sayaçlar -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
    <div class="xp-stat-counter-card xp-stat-card-primary">
        <span class="xp-stat-label">Toplam Bildiri</span>
        <strong class="xp-stat-value"><?= $totalCount ?></strong>
        <span class="xp-stat-sub">Kayıtlı duyuru</span>
    </div>
    <div class="xp-stat-counter-card xp-stat-card-success">
        <span class="xp-stat-label">Yayındaki Aktif Bildiriler</span>
        <strong class="xp-stat-value" style="color: var(--xp-emerald);"><?= $activeCount ?></strong>
        <span class="xp-stat-sub">Sitede ziyaretçilere açık</span>
    </div>
    <div class="xp-stat-counter-card xp-stat-card-warning">
        <span class="xp-stat-label">Taslak / Pasif</span>
        <strong class="xp-stat-value" style="color: var(--xp-amber);"><?= $totalCount - $activeCount ?></strong>
        <span class="xp-stat-sub">Gizlenen bildiriler</span>
    </div>
</div>

<div class="xp-table-card">
    <div class="xp-table-header-bar">
        <div>
            <h2 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 0.2rem 0;">
                Duyuru, Bülten ve Bildiriler
            </h2>
            <span style="font-size: 0.8rem; color: #64748b;">
                Site genelinde yayınlanan kamp, etkinlik ve stüdyo duyuruları
            </span>
        </div>
    </div>

    <?php if (empty($items)): ?>
        <p style="color: var(--xp-text-muted); font-size: 0.88rem; text-align: center; padding: 3rem;">
            Henüz duyuru veya bildiri eklenmemiş. Yukarıdaki '+ Yeni Bildiri / Duyuru Ekle' butonundan ilk duyurunuzu ekleyebilirsiniz.
        </p>
    <?php else: ?>
        <div class="xpanel-table-wrap">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th style="min-width: 220px;">Bildiri Başlığı &amp; Detayı</th>
                        <th style="width: 130px;">Kategori / Rozet</th>
                        <th style="width: 120px;">Tarih</th>
                        <th style="width: 150px;">Lokasyon / Kanal</th>
                        <th style="width: 110px;">Durum</th>
                        <th style="text-align: right; width: 120px;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <strong style="color: var(--xp-text); font-size: 0.95rem;"><?= e($item['title']) ?></strong>
                                <?php if (!empty($item['spot'])): ?>
                                    <div style="font-size: 0.78rem; color: var(--xp-text-muted); margin-top: 3px; max-width: 480px; white-space: normal; line-height: 1.4;">
                                        <?= e(mb_substr($item['spot'], 0, 110)) ?>...
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="background: #f1f5f9; color: #334155; padding: 3px 8px; border-radius: var(--xp-radius-pill); font-size: 0.72rem; font-weight: 700;">
                                    <?= e($item['badge'] ?: 'Genel') ?>
                                </span>
                            </td>
                            <td><strong><?= e($item['date_text'] ?: '-') ?></strong></td>
                            <td style="font-size: 0.82rem; color: var(--xp-text-muted);"><?= e($item['location'] ?: '-') ?></td>
                            <td>
                                <?php if ((int)$item['is_active'] === 1): ?>
                                    <span class="xp-status-pill xp-status-approved">● Yayında</span>
                                <?php else: ?>
                                    <span class="xp-status-pill xp-status-rejected">● Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end;">
                                    <button type="button" 
                                            class="xp-btn-action-pill xp-btn-action-edit"
                                            onclick='openEditAnnouncementModal(<?= json_encode($item, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                        Düzenle
                                    </button>

                                    <form action="<?= url('/xpanel/announcements/delete') ?>" method="POST" onsubmit="return confirm('Bu duyuruyu silmek istediğinize emin misiniz?');" style="display:inline; margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">Sil</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: Duyuru Ekleme & Düzenleme -->
<div id="announcementModal" class="xp-modal-backdrop">
    <div class="xp-modal-window">
        <div class="xp-modal-header">
            <h3 id="announcementModalTitle" class="xp-modal-title">Yeni Duyuru / Bildiri Ekle</h3>
            <button type="button" onclick="document.getElementById('announcementModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/announcements/save') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" id="ann_id" name="id" value="0">

            <div class="xp-form-group">
                <label class="xp-form-label" for="ann_title">Duyuru Başlığı *</label>
                <input type="text" id="ann_title" name="title" class="xp-form-input" required placeholder="Örn: 4 HAFTALIK METABOLİK DETOX & YOGA KAMPI">
            </div>

            <div class="xp-form-grid-2">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="ann_badge">Kategori / Rozet</label>
                    <input type="text" id="ann_badge" name="badge" class="xp-form-input" placeholder="Örn: 01. BİLDİRİ • ONLINE KAMP">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label" for="ann_date">Tarih Metni</label>
                    <input type="text" id="ann_date" name="date_text" class="xp-form-input" placeholder="Örn: 18 KASIM 2026">
                </div>
            </div>

            <div class="xp-form-grid-2">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="ann_location">Lokasyon / Kanal</label>
                    <input type="text" id="ann_location" name="location" class="xp-form-input" placeholder="Örn: CANLI ZOOM & WHATSAPP TAKİP GRUBU">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label" for="ann_sort">Görüntüleme Sırası</label>
                    <input type="number" id="ann_sort" name="sort_order" class="xp-form-input" value="1" min="1">
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="ann_spot">Kısa Özet (Spot Metni) *</label>
                <textarea id="ann_spot" name="spot" rows="2" class="xp-form-textarea" required placeholder="Duyurular listesinde ve sol sekmede görünecek kısa açıklama..."></textarea>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="ann_content">Detaylı Bülten İçeriği *</label>
                <textarea id="ann_content" name="content" rows="4" class="xp-form-textarea" required placeholder="Sağ alanda görünecek detaylı bildiri açıklaması..."></textarea>
            </div>

            <div class="xp-form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                <input type="checkbox" id="ann_active" name="is_active" value="1" checked style="width: 18px; height: 18px; accent-color: var(--xp-emerald);">
                <label for="ann_active" style="font-size: 0.88rem; font-weight: 600; color: var(--xp-text); cursor: pointer;">
                    Bu bildiriyi sitede aktif olarak yayınla
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--xp-border);">
                <button type="button" onclick="document.getElementById('announcementModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ Bildiriyi Kaydet &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openNewAnnouncementModal() {
    document.getElementById('announcementModalTitle').innerText = 'Yeni Bildiri / Duyuru Ekle';
    document.getElementById('ann_id').value = '0';
    document.getElementById('ann_title').value = '';
    document.getElementById('ann_badge').value = '';
    document.getElementById('ann_date').value = '';
    document.getElementById('ann_location').value = '';
    document.getElementById('ann_sort').value = '<?= $totalCount + 1 ?>';
    document.getElementById('ann_spot').value = '';
    document.getElementById('ann_content').value = '';
    document.getElementById('ann_active').checked = true;
    document.getElementById('announcementModal').style.display = 'flex';
}

function openEditAnnouncementModal(item) {
    document.getElementById('announcementModalTitle').innerText = 'Bildiriyi Düzenle: ' + item.title;
    document.getElementById('ann_id').value = item.id;
    document.getElementById('ann_title').value = item.title || '';
    document.getElementById('ann_badge').value = item.badge || '';
    document.getElementById('ann_date').value = item.date_text || '';
    document.getElementById('ann_location').value = item.location || '';
    document.getElementById('ann_sort').value = item.sort_order || 1;
    document.getElementById('ann_spot').value = item.spot || '';
    document.getElementById('ann_content').value = item.content || '';
    document.getElementById('ann_active').checked = (parseInt(item.is_active) === 1);
    document.getElementById('announcementModal').style.display = 'flex';
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>

