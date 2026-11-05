<?php
declare(strict_types=1);
?>

<div class="error-page">
    <div class="container text-center">
        <div class="error-box">
            <span class="error-code">404</span>
            <h1 class="error-title"><?= __('errors.page_not_found') ?></h1>
            <p class="error-desc"><?= __('errors.page_not_found_desc') ?></p>
            <a href="<?= url('/') ?>" class="btn btn-primary btn-lg"><?= __('errors.go_home') ?></a>
        </div>
    </div>
</div>

