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

    <div class="xpanel-card" style="border-left: 3px solid #16a34a;">
        <span style="font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted);">Toplam Onaylı Ciro</span>
        <div style="font-size: 2.2rem; font-weight: 500; color: #16a34a; margin-top: 0.25rem;">
            ₺<?= number_format((float)($stats['total_revenue'] ?? 0), 2, ',', '.') ?>
        </div>
        <span style="font-size: var(--font-xs); color: var(--text-muted);">Tüm onaylı ödemeler toplamı</span>
    </div>

    <div class="xpanel-card" style="border-left: 3px solid #ec4899;">
        <span style="font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted);">Studio İçerik Sayısı</span>
        <div style="font-size: 2.2rem; font-weight: 500; color: #db2777; margin-top: 0.25rem;">
            <?= (int)($stats['total_nutrition'] ?? 0) ?>
        </div>
        <a href="<?= url('/xpanel/nutrition') ?>" style="font-size: var(--font-xs); color: #db2777; text-decoration: underline;">Tarif &amp; Rehberleri yönet &rarr;</a>
    </div>
</div>

<!-- Son Ödeme ve Kayıt Bildirimleri -->
<div class="xpanel-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2 style="font-size: 1.15rem; font-weight: 500; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em;">
            Son Abonelik & Ödeme Bildirimleri
        </h2>
        <a href="<?= url('/xpanel/enrollments') ?>" class="xp-btn-pill-outline" style="font-size: 0.75rem; padding: 0.35rem 0.9rem;">Tümünü Gör &rarr;</a>
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
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-approve">✓ Onayla</button>
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

