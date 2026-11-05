<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<!-- İstatistik Sayaçları -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="xpanel-card" style="border-left: 3px solid #f59e0b;">
        <span style="font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted);">Bekleyen IBAN Ödemeleri</span>
        <div style="font-size: 2.2rem; font-weight: 500; color: #b45309; margin-top: 0.25rem;">
            <?= (int)$stats['pending_enrollments'] ?>
        </div>
        <a href="<?= url('/xpanel/enrollments') ?>" style="font-size: var(--font-xs); color: #d97706; text-decoration: underline;">Onay bekleyenleri incele &rarr;</a>
    </div>

    <div class="xpanel-card" style="border-left: 3px solid #10b981;">
        <span style="font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted);">Aktif Öğrenci Aboneliği</span>
        <div style="font-size: 2.2rem; font-weight: 500; color: #047857; margin-top: 0.25rem;">
            <?= (int)$stats['approved_enrollments'] ?>
        </div>
        <span style="font-size: var(--font-xs); color: var(--text-muted);">Aktif eğitim erişimi olan</span>
    </div>

    <div class="xpanel-card" style="border-left: 3px solid var(--primary);">
        <span style="font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted);">Kayıtlı Öğrenci Sayısı</span>
        <div style="font-size: 2.2rem; font-weight: 500; color: var(--black); margin-top: 0.25rem;">
            <?= (int)$stats['total_students'] ?>
        </div>
        <a href="<?= url('/xpanel/users') ?>" style="font-size: var(--font-xs); color: var(--primary); text-decoration: underline;">Öğrenci listesi &rarr;</a>
    </div>

    <div class="xpanel-card" style="border-left: 3px solid #6366f1;">
        <span style="font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted);">Eğitim Programı</span>
        <div style="font-size: 2.2rem; font-weight: 500; color: #4338ca; margin-top: 0.25rem;">
            <?= (int)$stats['total_courses'] ?>
        </div>
        <a href="<?= url('/xpanel/courses') ?>" style="font-size: var(--font-xs); color: #4f46e5; text-decoration: underline;">Programları yönet &rarr;</a>
    </div>
</div>

<!-- Son Ödeme ve Kayıt Bildirimleri -->
<div class="xpanel-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2 style="font-size: 1.15rem; font-weight: 500; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em;">
            Son Abonelik & Ödeme Bildirimleri
        </h2>
        <a href="<?= url('/xpanel/enrollments') ?>" class="btn btn-outline btn-xs">Tümünü Gör</a>
    </div>

    <?php if (empty($recentEnrollments)): ?>
        <p style="color: var(--text-muted); font-size: var(--font-sm);">Henüz bir ödeme kaydı bulunmuyor.</p>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Öğrenci Adı</th>
                        <th>E-Posta / İletişim</th>
                        <th>Program</th>
                        <th>Yöntem</th>
                        <th>Tutar</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentEnrollments as $r): ?>
                        <tr>
                            <td>#<?= $r['id'] ?></td>
                            <td><strong><?= e($r['user_name']) ?></strong></td>
                            <td><?= e($r['user_email']) ?></td>
                            <td><?= e($r['course_title']) ?></td>
                            <td><span style="text-transform: uppercase; font-size: 0.75rem; font-weight: 600;"><?= e($r['payment_method']) ?></span></td>
                            <td>₺<?= number_format((float)$r['amount'], 2, ',', '.') ?></td>
                            <td>
                                <?php if ($r['payment_status'] === 'approved'): ?>
                                    <span style="color: #065f46; background: #ecfdf5; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">ONAYLANDI</span>
                                <?php elseif ($r['payment_status'] === 'pending'): ?>
                                    <span style="color: #92400e; background: #fffbeb; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">ONAY BEKLİYOR</span>
                                <?php else: ?>
                                    <span style="color: #991b1b; background: #fee2e2; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">REDDEDİLDİ</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size: 0.75rem; color: var(--text-muted);"><?= substr($r['created_at'], 0, 16) ?></td>
                            <td>
                                <?php if ($r['payment_status'] === 'pending'): ?>
                                    <form action="<?= url('/xpanel/enrollments/approve') ?>" method="POST" style="display: inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="btn btn-primary btn-xs" style="padding: 2px 8px; font-size: 0.7rem;">ONAYLA</button>
                                    </form>
                                <?php else: ?>
                                    <span style="font-size: 0.75rem; color: var(--text-light);">-</span>
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

