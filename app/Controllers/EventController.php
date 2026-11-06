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
            'activeTab' => 'events',
        ]);
    }

    public function announcements(): void
    {
        $this->render('pages/announcements', [
            'metaTitle' => 'Duyurular | FİZYOBAR Wellness Experiences',
            'metaDescription' => 'Fizyobar yeni dönem online kampları, canlı atölyeler ve stüdyo kayıt duyuruları.',
            'activeTab' => 'announcements',
        ]);
    }

    public function news(): void
    {
        $this->render('pages/news', [
            'metaTitle' => 'Haberler & Basın | FİZYOBAR Wellness Experiences',
            'metaDescription' => 'Fizyobar topluluk haberleri, etkinlik gelişmeleri ve basında yer alan röportajlar.',
            'activeTab' => 'news',
        ]);
    }
}

