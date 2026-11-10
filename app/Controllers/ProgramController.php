<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;
use Core\Database;

class ProgramController extends Controller
{
    public function index(): void
    {
        $courses = Database::query(
            "SELECT c.*, (SELECT COUNT(*) FROM course_lessons WHERE course_id = c.id) as lesson_count 
             FROM courses c 
             WHERE c.is_active = 1 
             ORDER BY c.sort_order ASC, c.id DESC"
        );

        $this->render('pages/programs', [
            'metaTitle' => Language::get('programs_page.meta_title'),
            'metaDescription' => Language::get('programs_page.meta_description'),
            'courses' => $courses
        ]);
    }

    /**
     * 4 Haftalık Online Detox & Yoga Kampı Özel Sayfası
     */
    public function detox(): void
    {
        $campCourse = Database::query(
            "SELECT c.*, (SELECT COUNT(*) FROM course_lessons WHERE course_id = c.id) as lesson_count 
             FROM courses c 
             WHERE c.id = 1 LIMIT 1"
        )[0] ?? null;

        $this->render('pages/detox', [
            'metaTitle' => '4 Haftalık Online Detox & Yoga Kampı | FİZYOBAR',
            'metaDescription' => 'Fizyoterapist Betina Tansuğ rehberliğinde 4 haftalık bütünsel online detox & yoga kampı. Canlı dersler, birebir WhatsApp takibi ve glisemik beslenme.',
            'camp' => $campCourse
        ]);
    }

    /**
     * Adım Adım Yapay Zeka Destekli "Programını Bul" Test Sayfası
     */
    public function finder(): void
    {
        $courses = Database::query(
            "SELECT c.*, (SELECT COUNT(*) FROM course_lessons WHERE course_id = c.id) as lesson_count 
             FROM courses c 
             WHERE c.is_active = 1 
             ORDER BY c.sort_order ASC, c.id DESC"
        );

        $this->render('pages/find-program', [
            'metaTitle' => 'Programını Bul | Yapay Zeka Beden & İhtiyaç Analizi | FİZYOBAR',
            'metaDescription' => 'Fizyoterapist Betina Tansuğ metodolojisi ve yapay zeka ile bedeninize en uygun Fizyobar programını 2 dakikada bulun.',
            'courses' => $courses
        ]);
    }
}
