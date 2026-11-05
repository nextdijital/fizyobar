<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('pages/home', [
            'metaTitle' => Language::get('home.meta_title'),
            'metaDescription' => Language::get('home.meta_description'),
        ]);
    }
}

