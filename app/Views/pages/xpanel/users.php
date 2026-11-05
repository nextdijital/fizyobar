<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 400; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em;">
            Kullanıcı & Öğrenci Yönetimi
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm);">
            Kayıtlı öğrencileri, rolleri ve aktif program sayılarını görüntüleyin.
        </p>
    </div>
</div>

<div class="xpanel-card">
    <div style="overflow-x: auto;">
        <table class="xpanel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad Soyad</th>
                    <th>E-Posta</th>
                    <th>Telefon</th>
                    <th>Rol</th>
                    <th>Aktif Program</th>
                    <th>Durum</th>
                    <th>Kayıt Tarihi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td>#<?= $u['id'] ?></td>
                        <td><strong><?= e($u['full_name']) ?></strong></td>
                        <td><?= e($u['email']) ?></td>
                        <td><?= e($u['phone'] ?? '-') ?></td>
                        <td>
                            <?php if ($u['role'] === 'admin'): ?>
                                <span style="background-color: var(--primary); color: #fff; padding: 2px 7px; border-radius: 3px; font-size: 0.72rem; font-weight: 600;">YÖNETİCİ</span>
                            <?php else: ?>
                                <span style="background-color: #f1f5f9; color: #475569; padding: 2px 7px; border-radius: 3px; font-size: 0.72rem;">ÖĞRENCİ</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= (int)$u['active_courses'] ?></strong> Program
                        </td>
                        <td>
                            <span style="color: #065f46; font-size: 0.75rem; font-weight: 600;">Aktif</span>
                        </td>
                        <td style="font-size: 0.75rem; color: var(--text-muted);"><?= substr($u['created_at'], 0, 10) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>

