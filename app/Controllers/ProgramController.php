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
}
