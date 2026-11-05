<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

class EventController extends Controller
{
    public function index(): void
    {
        $this->render('pages/events', [
            'metaTitle' => Language::get('events_page.meta_title'),
            'metaDescription' => Language::get('events_page.meta_description'),
        ]);
    }
}

