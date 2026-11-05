<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

class LegalController extends Controller
{
    public function privacy(): void
    {
        $this->render('pages/legal/privacy', [
            'metaTitle' => Language::get('legal.privacy_title') . ' | ' . Language::get('common.site_title'),
            'metaDescription' => Language::get('legal.privacy_desc'),
        ]);
    }

    public function terms(): void
    {
        $this->render('pages/legal/terms', [
            'metaTitle' => Language::get('legal.terms_title') . ' | ' . Language::get('common.site_title'),
            'metaDescription' => Language::get('legal.terms_desc'),
        ]);
    }

    public function cookies(): void
    {
        $this->render('pages/legal/cookies', [
            'metaTitle' => Language::get('legal.cookies_title') . ' | ' . Language::get('common.site_title'),
            'metaDescription' => Language::get('legal.cookies_desc'),
        ]);
    }

    public function kvkk(): void
    {
        $this->render('pages/legal/kvkk', [
            'metaTitle' => Language::get('legal.kvkk_title') . ' | ' . Language::get('common.site_title'),
            'metaDescription' => Language::get('legal.kvkk_desc'),
        ]);
    }

    public function refund(): void
    {
        $this->render('pages/legal/refund', [
            'metaTitle' => Language::get('legal.refund_title') . ' | ' . Language::get('common.site_title'),
            'metaDescription' => Language::get('legal.refund_desc'),
        ]);
    }
}

