<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;
use Core\Session;
use Core\Security;

class CorporateController extends Controller
{
    public function index(): void
    {
        $flash = Session::getFlash('corporate_success');

        $this->render('pages/corporate', [
            'metaTitle' => Language::get('corporate_page.meta_title'),
            'metaDescription' => Language::get('corporate_page.meta_description'),
            'flashSuccess' => $flash,
        ]);
    }

    public function about(): void
    {
        $this->render('pages/about', [
            'metaTitle' => 'Betina Tansuğ & Fizyobar | Kurumsal Profil & Biyografi',
            'metaDescription' => 'Fizyoterapist & Yoga Eğitmeni Betina Tansuğ ve Fizyobar bütünsel sağlık, klinik anatomi ve longevity disiplini.',
        ]);
    }

    public function submit(): void
    {
        $name = Security::escape($this->input('name'));
        $company = Security::escape($this->input('company'));
        $email = filter_var($this->input('email'), FILTER_VALIDATE_EMAIL);
        $phone = Security::escape($this->input('phone'));
        $message = Security::escape($this->input('message'));

        // Kurumsal teklif talebini kaydet veya e-posta/log ile bildir
        $logData = date('Y-m-d H:i:s') . " | {$name} | {$company} | {$email} | {$phone}\n";
        @file_put_contents(__DIR__ . '/../../storage/logs/corporate_leads.log', $logData, FILE_APPEND);

        Session::setFlash('corporate_success', Language::get('corporate_page.form_success'));

        $this->redirect(url('/corporate#teklif-formu'));
    }
}

