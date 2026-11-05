<?php
declare(strict_types=1);
?>

<div class="error-page">
    <div class="container text-center">
        <div class="error-box">
            <span class="error-code">419</span>
            <h1 class="error-title">Güvenlik Doğrulaması Süresi Doldu</h1>
            <p class="error-desc"><?= e($message ?? __('errors.csrf_expired')) ?></p>
            <a href="<?= url('/') ?>" class="btn btn-primary btn-lg"><?= __('errors.go_home') ?></a>
        </div>
    </div>
</div>

