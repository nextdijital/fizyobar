<?php
declare(strict_types=1);

/**
 * Fizyobar Studio Ana Sayfası doğrudan Ana Sayfaya yönlendirilir.
 */
header('Location: ' . url('/'), true, 301);
exit;
