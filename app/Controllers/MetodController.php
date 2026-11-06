<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

class MetodController extends Controller
{
    public function index(): void
    {
        $this->redirect(url('/studio'));
    }
}

