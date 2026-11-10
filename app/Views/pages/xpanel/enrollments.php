<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$pendingList = array_filter($enrollments, fn($e) => $e['payment_status'] === 'pending');
$approvedList = array_filter($enrollments, fn($e) => $e['payment_status'] === 'approved');
$totalVolume = array_reduce($approvedList, fn($acc, $e) => $acc + (float)$e['amount'], 0);
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 500; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">
            Abonelik, Sipariş &amp; Havale Onay Merkezi
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm); margin: 0;">
            Öğrencilerin yaptığı banka havale bildirimlerini onaylayın, siparişleri kontrol edin veya manuel kayıt oluşturun.
        </p>
    </div>

    <button type="button" onclick="document.getElementById('manualEnrollModal').style.display='flex';" class="xp-btn-pill-primary">
        + MANUEL KAYIT / SİPARİŞ EKLE &rarr;
    </button>
</div>

<!-- Özet Sayaçlar -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Onay Bekleyenler</span>
        <strong style="font-size: 1.6rem; color: #d97706;"><?= count($pendingList) ?></strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Onaylanan Kayıtlar</span>
        <strong style="font-size: 1.6rem; color: #16a34a;"><?= count($approvedList) ?></strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Toplam Onaylanan Tutar</span>
        <strong style="font-size: 1.6rem; color: var(--black);">₺<?= number_format($totalVolume, 2, ',', '.') ?></strong>
    </div>
</div>

<div class="xpanel-card">
    <?php if (empty($enrollments)): ?>
        <p style="color: var(--text-muted); font-size: var(--font-sm); text-align: center; padding: 2rem;">
            Henüz ödeme veya kayıt bildirimi bulunmuyor.
        </p>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Öğrenci Adı</th>
                        <th>İletişim</th>
                        <th>Kayıt Olunan Program</th>
                        <th>Tutar</th>
                        <th>Havale Yapan İsim</th>
                        <th>Dekont / Ref</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th style="text-align: right;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enrollments as $e): ?>
                        <tr>
                            <td>#<?= $e['id'] ?></td>
                            <td><strong><?= e($e['user_name']) ?></strong></td>
                            <td>
                                <div><?= e($e['user_email']) ?></div>
                                <div style="font-size: 0.72rem; color: var(--text-muted);"><?= e($e['user_phone'] ?? '') ?></div>
                            </td>
                            <td><?= e($e['course_title']) ?></td>
                            <td><strong>₺<?= number_format((float)$e['amount'], 2, ',', '.') ?></strong></td>
                            <td><?= e($e['sender_name'] ?? '-') ?></td>
                            <td><code><?= e($e['receipt_ref'] ?? '-') ?></code></td>
                            <td>
                                <?php if ($e['payment_status'] === 'approved'): ?>
                                    <span style="color: #065f46; background: #ecfdf5; border: 1px solid #a7f3d0; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ✓ ONAYLANDI (AKTİF)
                                    </span>
                                <?php elseif ($e['payment_status'] === 'pending'): ?>
                                    <span style="color: #92400e; background: #fffbeb; border: 1px solid #fde68a; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ⏳ ONAY BEKLİYOR
                                    </span>
                                <?php else: ?>
                                    <span style="color: #991b1b; background: #fee2e2; border: 1px solid #fecaca; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ✗ REDDEDİLDİ
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size: 0.75rem; color: var(--text-muted);"><?= substr($e['created_at'], 0, 16) ?></td>
                            <td style="text-align: right;">
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

                                    <!-- Sil -->
                                    <form action="<?= url('/xpanel/enrollments/delete') ?>" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('Bu abonelik kaydını silmek istediğinize emin misiniz?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">
                                            Sil
                                        </button>
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

<!-- Modal: Manuel Kayıt / Sipariş Ekle -->
<div id="manualEnrollModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: 12px; max-width: 520px; width: 100%; padding: 2rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h3 style="font-size: 1.15rem; font-weight: 700; color: #111; margin: 0;">Yeni Abonelik / Satın Alma Ekle</h3>
            <button type="button" onclick="document.getElementById('manualEnrollModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748b;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/enrollments/save') ?>" method="POST">
            <?= csrf_field() ?>

            <div style="margin-bottom: 1rem;">
                <label class="form-label" for="manual_user_id" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Öğrenci / Kullanıcı Seçin *</label>
                <select id="manual_user_id" name="user_id" class="form-input" required style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
                    <option value="">-- Öğrenci Seçin --</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id'] ?>"><?= e($u['full_name']) ?> (<?= e($u['email']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 1rem;">
                <label class="form-label" for="manual_course_id" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Eğitim Programı *</label>
                <select id="manual_course_id" name="course_id" class="form-input" required style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
                    <option value="">-- Program Seçin --</option>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= e($c['title']) ?> (₺<?= number_format((float)$c['price'], 2) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="manual_amount" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Tutar (₺)</label>
                    <input type="number" step="0.01" id="manual_amount" name="amount" value="0.00" class="form-input" style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label class="form-label" for="manual_status" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Erişim / Ödeme Durumu</label>
                    <select id="manual_status" name="payment_status" class="form-input" style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
                        <option value="approved">Onaylı (Erişim Açık)</option>
                        <option value="pending">Onay Bekliyor</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label class="form-label" for="manual_sender" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Havale Yapan Ad / Not</label>
                <input type="text" id="manual_sender" name="sender_name" value="Yönetici Tarafından Eklendi" class="form-input" style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" onclick="document.getElementById('manualEnrollModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ Kaydı Oluştur &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>
