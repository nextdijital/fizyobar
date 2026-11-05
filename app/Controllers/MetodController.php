<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

class MetodController extends Controller
{
    public function index(): void
    {
        $this->render('pages/metod', [
            'metaTitle' => Language::get('metod_page.meta_title'),
            'metaDescription' => Language::get('metod_page.meta_description'),
        ]);
    }
}

