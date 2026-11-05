<?php
declare(strict_types=1);
?>

<div class="page-hero">
    <div class="container">
        <span class="badge-pill section-badge">ÖĞRENCİ PORTALİ</span>
        <h1 class="section-title" style="font-size: var(--font-h1);">Hoş Geldin, <?= e($user['full_name']) ?></h1>
        <p class="section-subtitle">Eğitimlerinizi takip edin, video derslerinizi izleyin ve rozetlerinizi toplayın.</p>
        
        <div style="margin-top: 1rem;">
            <a href="<?= url('/logout') ?>" class="btn btn-outline btn-xs">Çıkış Yap</a>
        </div>
    </div>
</div>

<section style="padding: var(--space-xl) 0;">
    <div class="container">
        
        <!-- Rozetler Alanı (Gamification) -->
        <div style="background-color: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: clamp(1.5rem, 3vw, 2.5rem); margin-bottom: var(--space-xl); box-shadow: var(--shadow-subtle);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.5rem;">
                <h3 style="font-size: 1.25rem; font-weight: 400; color: var(--black); text-transform: uppercase; letter-spacing: 0.08em;">
                    🏆 Kazanılan Başarı Rozetleri
                </h3>
                <span style="font-size: var(--font-xs); color: var(--text-muted); letter-spacing: 0.05em;">
                    Toplam <?= count($badges) ?> Rozet Kazanıldı
                </span>
            </div>

            <?php if (empty($badges)): ?>
                <p style="color: var(--text-muted); font-size: var(--font-sm); font-weight: 300;">
                    Henüz bir rozet kazanmadınız. Video derslerinizi tamamladıkça ilerleme rozetleriniz burada parlayacak!
                </p>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    <?php foreach ($badges as $b): ?>
                        <div style="background-color: var(--off-white); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 1.25rem; text-align: center;">
                            <div style="font-size: 2.2rem; margin-bottom: 0.4rem;"><?= e($b['badge_icon']) ?></div>
                            <div style="font-size: 0.85rem; font-weight: 500; color: var(--black);"><?= e($b['badge_name']) ?></div>
                            <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 2px;"><?= e($b['course_title'] ?? '') ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Kayıtlı Programlarım -->
        <div class="section-header" style="text-align: left; margin-bottom: var(--space-md);">
            <h2 class="section-title" style="font-size: 1.45rem;">Kayıtlı Programlarım</h2>
            <p class="section-subtitle">Derslerinize kaldığınız yerden devam edin.</p>
        </div>

        <?php if (empty($enrollments)): ?>
            <div style="background-color: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: var(--space-xl); text-align: center;">
                <p style="color: var(--text-muted); font-size: 1.05rem; margin-bottom: 1.25rem;">
                    Henüz aktif bir eğitim programınız bulunmuyor.
                </p>
                <a href="<?= url('/programs') ?>" class="btn btn-primary btn-lg">
                    PROGRAMLARI İNCELE &rarr;
                </a>
            </div>
        <?php else: ?>
            <div class="cards-grid">
                <?php foreach ($enrollments as $enr): ?>
                    <div class="program-item-card">
                        <div class="program-item-thumb" style="background: var(--bordo, #391214);">
                            <span><?= e($enr['course_title']) ?></span>
                        </div>
                        <div class="program-item-body">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                <?php if ($enr['payment_status'] === 'approved'): ?>
                                    <span class="badge-pill" style="background-color: #ecfdf5; color: #065f46; border-color: #a7f3d0;">
                                        ✓ AKTİF ERİŞİM
                                    </span>
                                <?php elseif ($enr['payment_status'] === 'pending'): ?>
                                    <span class="badge-pill" style="background-color: #fffbeb; color: #b45309; border-color: #fde68a;">
                                        ⏳ ÖDEME ONAY BEKLİYOR
                                    </span>
                                <?php else: ?>
                                    <span class="badge-pill" style="background-color: #fef2f2; color: #b91c1c; border-color: #fecaca;">
                                        ✗ ONAYLANMADI
                                    </span>
                                <?php endif; ?>

                                <span style="font-size: var(--font-xs); color: var(--text-muted);">
                                    <?= (int)$enr['duration_weeks'] ?> Hafta
                                </span>
                            </div>

                            <h3 class="program-item-title"><?= e($enr['course_title']) ?></h3>

                            <?php if ($enr['payment_status'] === 'approved'): ?>
                                <!-- İlerleme Çubuğu -->
                                <div style="margin: 1rem 0;">
                                    <div style="display: flex; justify-content: space-between; font-size: var(--font-xs); margin-bottom: 0.35rem; color: var(--text-muted);">
                                        <span>Tamamlanan: <?= $enr['completed_lessons'] ?> / <?= $enr['total_lessons'] ?> Ders</span>
                                        <strong>%<?= $enr['progress_percent'] ?></strong>
                                    </div>
                                    <div style="width: 100%; height: 6px; background-color: var(--border-color); border-radius: 3px; overflow: hidden;">
                                        <div style="width: <?= $enr['progress_percent'] ?>%; height: 100%; background-color: var(--primary); transition: width 0.4s ease;"></div>
                                    </div>
                                </div>

                                <div class="program-item-footer">
                                    <a href="<?= url('/course/' . $enr['course_slug']) ?>" class="btn btn-primary btn-sm" style="width: 100%;">
                                        DERSE DEVAM ET &rarr;
                                    </a>
                                </div>
                            <?php else: ?>
                                <p style="font-size: var(--font-xs); color: var(--text-muted); margin: 1rem 0;">
                                    Havale / EFT bildiriminiz incelenmektedir. Yetkili onayının ardından video dersleriniz anında açılacaktır.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

