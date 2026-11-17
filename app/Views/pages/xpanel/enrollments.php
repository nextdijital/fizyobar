<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$pendingList = array_filter($enrollments, fn($e) => $e['payment_status'] === 'pending');
$approvedList = array_filter($enrollments, fn($e) => $e['payment_status'] === 'approved');
$totalVolume = array_reduce($approvedList, fn($acc, $e) => $acc + (float)$e['amount'], 0);
?>

<div class="xp-dash-header">
    <div>
        <h1 class="xp-dash-title">Abonelik &amp; Havale Bildirimleri</h1>
        <p class="xp-dash-subtitle">Öğrenci havale bildirimleri, dekontlar ve sipariş onay yönetimi</p>
    </div>

    <div class="xp-dash-actions">
        <button type="button" onclick="document.getElementById('manualEnrollModal').style.display='flex';" class="xp-btn-pill-primary">
            <span>+</span>
            <span>Manuel Kayıt Ekle</span>
        </button>
    </div>
</div>

<!-- Özet Sayaçlar (OripioFin Stili) -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
    <div class="xp-oripio-card-white" style="min-height: 140px;">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #fffbeb; color: #b45309;">⏳</div>
                <div>
                    <div class="xp-oripio-label">Onay Bekleyenler</div>
                    <div class="xp-oripio-sublabel">İncelenmesi gereken havaleler</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body" style="margin: 0.8rem 0 0;">
            <div class="xp-oripio-metric" style="color: <?= count($pendingList) > 0 ? '#b45309' : '#0f172a' ?>;">
                <?= count($pendingList) ?>
            </div>
            <span class="xp-oripio-badge <?= count($pendingList) > 0 ? 'xp-oripio-badge-amber' : 'xp-oripio-badge-green' ?>">
                <?= count($pendingList) > 0 ? '● İşlem Bekliyor' : '✓ Bekleyen Yok' ?>
            </span>
        </div>
    </div>

    <div class="xp-oripio-card-white" style="min-height: 140px;">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #ecfdf5; color: #047857;">✓</div>
                <div>
                    <div class="xp-oripio-label">Onaylanan Kayıtlar</div>
                    <div class="xp-oripio-sublabel">Aktif erişim verilen siparişler</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body" style="margin: 0.8rem 0 0;">
            <div class="xp-oripio-metric" style="color: #047857;">
                <?= count($approvedList) ?>
            </div>
            <span class="xp-oripio-badge xp-oripio-badge-green">
                ● Aktif Öğrenci
            </span>
        </div>
    </div>

    <div class="xp-oripio-card-dark" style="min-height: 140px;">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap">💳</div>
                <div>
                    <div class="xp-oripio-label" style="color: #ffffff;">Toplam Onaylanan Ciro</div>
                    <div class="xp-oripio-sublabel">Kasa toplam hacmi</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body" style="margin: 0.8rem 0 0;">
            <div class="xp-oripio-metric" style="color: #ffffff; font-size: 1.85rem;">
                ₺<?= number_format($totalVolume, 2, ',', '.') ?>
            </div>
            <span class="xp-oripio-badge">
                ↑ %100 Tahsil Edildi
            </span>
        </div>
    </div>
</div>

<div class="xp-table-card">
    <div class="xp-table-header-bar">
        <div>
            <h2 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 0.2rem 0;">
                Tüm Havale ve Sipariş Kayıtları
            </h2>
            <span style="font-size: 0.8rem; color: #64748b;">
                Öğrenci bildirimleri ve ödeme onay geçmişi
            </span>
        </div>

        <div style="display: flex; align-items: center; gap: 0.65rem;">
            <div class="xp-table-search-box">
                <span style="font-size: 0.85rem; color: #94a3b8;">🔍</span>
                <input type="text" id="enrollmentsSearch" placeholder="İsim, e-posta veya dekont ara..." onkeyup="filterEnrollmentsTable(this.value)">
            </div>
        </div>
    </div>

    <?php if (empty($enrollments)): ?>
        <p style="color: #64748b; font-size: 0.9rem; text-align: center; padding: 2.5rem 0;">
            Henüz ödeme veya kayıt bildirimi bulunmuyor.
        </p>
    <?php else: ?>
        <div class="xpanel-table-wrap">
            <table class="xpanel-table" id="enrollmentsTable">
                <thead>
                    <tr>
                        <th style="width: 36px; text-align: center;">
                            <input type="checkbox" class="xp-check-cell">
                        </th>
                        <th style="min-width: 170px;">Öğrenci Bilgisi</th>
                        <th style="min-width: 160px;">Program</th>
                        <th style="width: 95px;">Tutar</th>
                        <th style="min-width: 130px;">Havale Yapan</th>
                        <th style="width: 110px;">Dekont / Ref</th>
                        <th style="width: 130px;">Durum</th>
                        <th style="width: 110px; white-space: nowrap;">Tarih</th>
                        <th style="text-align: right; width: 130px;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enrollments as $e): 
                        $initial = mb_strtoupper(mb_substr(trim($e['user_name'] ?? 'Ö'), 0, 1));
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
                                        <div class="xp-user-cell-name"><?= e($e['user_name']) ?></div>
                                        <div class="xp-user-cell-meta">
                                            <?= e($e['user_email']) ?>
                                            <?php if (!empty($e['user_phone'])): ?>
                                                &bull; <?= e($e['user_phone']) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; font-size: 0.84rem; color: #0f172a; line-height: 1.35;">
                                    <?= e($e['course_title']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="xp-amount-val">
                                    ₺<?= number_format((float)$e['amount'], 2, ',', '.') ?>
                                </span>
                            </td>
                            <td>
                                <div style="font-size: 0.82rem; color: #334155; font-weight: 500;">
                                    <?= e($e['sender_name'] ?? '-') ?>
                                </div>
                            </td>
                            <td>
                                <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-size: 0.76rem; color: #475569;">
                                    <?= e($e['receipt_ref'] ?? '-') ?>
                                </code>
                            </td>
                            <td>
                                <?php if ($e['payment_status'] === 'approved'): ?>
                                    <span class="xp-status-dot-pill xp-status-dot-approved">
                                        <span class="dot"></span> Onaylandı
                                    </span>
                                <?php elseif ($e['payment_status'] === 'pending'): ?>
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
                                <div class="xp-date-primary"><?= date('d.m.Y', strtotime($e['created_at'])) ?></div>
                                <div class="xp-date-sub"><?= date('H:i', strtotime($e['created_at'])) ?></div>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end;">
                                    <?php if ($e['payment_status'] === 'pending'): ?>
                                        <form action="<?= url('/xpanel/enrollments/approve') ?>" method="POST" style="display: inline; margin: 0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                            <button type="submit" class="xp-btn-action-pill xp-btn-action-approve">✓ Onayla</button>
                                        </form>
                                        <form action="<?= url('/xpanel/enrollments/reject') ?>" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('Bu ödemeyi reddetmek istediğinize emin misiniz?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                            <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">Reddet</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?= url('/xpanel/enrollments/approve') ?>" method="POST" style="display: inline; margin: 0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                            <button type="submit" class="xp-btn-action-pill xp-btn-action-edit" title="Durumu Onaylı Olarak Yenile">
                                                Aktif Et
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script>
function filterEnrollmentsTable(val) {
    const filter = val.toLowerCase();
    const rows = document.querySelectorAll('#enrollmentsTable tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}
</script>

<!-- Modal: Manuel Kayıt / Sipariş Ekle -->
<div id="manualEnrollModal" class="xp-modal-backdrop">
    <div class="xp-modal-window">
        <div class="xp-modal-header">
            <h3 class="xp-modal-title">Yeni Abonelik / Sipariş Ekle</h3>
            <button type="button" onclick="document.getElementById('manualEnrollModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/enrollments/save') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>

            <div class="xp-form-group">
                <label class="xp-form-label" for="manual_user_id">Öğrenci / Kullanıcı Seçin *</label>
                <select id="manual_user_id" name="user_id" class="xp-form-select" required>
                    <option value="">-- Öğrenci Seçin --</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id'] ?>"><?= e($u['full_name']) ?> (<?= e($u['email']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="manual_course_id">Eğitim Programı *</label>
                <select id="manual_course_id" name="course_id" class="xp-form-select" required>
                    <option value="">-- Program Seçin --</option>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= e($c['title']) ?> (₺<?= number_format((float)$c['price'], 2) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                <div>
                    <label class="xp-form-label" for="manual_amount">Tutar (₺)</label>
                    <input type="number" step="0.01" id="manual_amount" name="amount" value="0.00" class="xp-form-input">
                </div>
                <div>
                    <label class="xp-form-label" for="manual_status">Erişim / Ödeme Durumu</label>
                    <select id="manual_status" name="payment_status" class="xp-form-select">
                        <option value="approved">Onaylı (Erişim Açık)</option>
                        <option value="pending">Onay Bekliyor</option>
                    </select>
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="manual_sender">Havale Yapan Ad / Not</label>
                <input type="text" id="manual_sender" name="sender_name" value="Yönetici Tarafından Eklendi" class="xp-form-input">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('manualEnrollModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ Kaydı Oluştur &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>
