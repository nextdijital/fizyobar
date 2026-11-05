<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 400; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em;">
            IBAN & Abonelik Ödeme Onay Merkezi
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm);">
            Öğrencilerin yaptığı banka havale bildirimlerini onaylayarak video ders erişimlerini anında açın.
        </p>
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
                        <th>İşlemler</th>
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
                                    <span style="color: #065f46; background: #ecfdf5; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ✓ ONAYLANDI (AKTİF)
                                    </span>
                                <?php elseif ($e['payment_status'] === 'pending'): ?>
                                    <span style="color: #92400e; background: #fffbeb; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ⏳ ONAY BEKLİYOR
                                    </span>
                                <?php else: ?>
                                    <span style="color: #991b1b; background: #fee2e2; padding: 3px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ✗ REDDEDİLDİ
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size: 0.75rem; color: var(--text-muted);"><?= substr($e['created_at'], 0, 16) ?></td>
                            <td>
                                <?php if ($e['payment_status'] === 'pending'): ?>
                                    <div style="display: flex; gap: 0.35rem;">
                                        <form action="<?= url('/xpanel/enrollments/approve') ?>" method="POST" style="display: inline;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                            <button type="submit" class="btn btn-primary btn-xs" style="padding: 3px 9px;">ONAYLA</button>
                                        </form>
                                        <form action="<?= url('/xpanel/enrollments/reject') ?>" method="POST" style="display: inline;" onsubmit="return confirm('Bu ödemeyi reddetmek istediğinize emin misiniz?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                            <button type="submit" class="btn btn-outline btn-xs" style="color: #b91c1c; border-color: #fca5a5; padding: 3px 9px;">Reddet</button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <span style="font-size: 0.75rem; color: var(--text-light);"><?= $e['approved_at'] ? 'Onay: ' . substr($e['approved_at'], 0, 10) : '-' ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>

