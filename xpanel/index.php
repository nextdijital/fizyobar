<?php
declare(strict_types=1);

/**
 * Fizyobar xPanel Giriş & Yönetim Noktası
 * xpanel/ dizinine doğrudan gelen istekleri güvenli /xpanel/login sayfasına yönlendirir.
 */
$scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '');
$base = rtrim(dirname($scriptDir), '/\\');
$loginUrl = ($base === '' ? '' : $base) . '/xpanel/login';

header("Location: {$loginUrl}", true, 302);
exit;
