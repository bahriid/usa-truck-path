<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseViewTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            ['course_id' => 9, 'view_name' => 'front.commercial-leaner-s-permit-clp-english'],
            ['course_id' => 10, 'view_name' => 'front.commercial-leaner-s-permit-clp-arabic'],
            ['course_id' => 11, 'view_name' => 'front.commercial-leaner-s-permit-clp-amharic'],
            ['course_id' => 12, 'view_name' => 'front.commercial-leaner-s-permit-clp-french'],
            ['course_id' => 13, 'view_name' => 'front.commercial-leaner-s-permit-clp-nepali'],
            ['course_id' => 14, 'view_name' => 'front.commercial-leaner-s-permit-clp-somali'],
            ['course_id' => 15, 'view_name' => 'front.cdl-canada'],
            ['course_id' => 16, 'view_name' => 'front.cdl-europe'],
            ['course_id' => 17, 'view_name' => 'front.cdl-global'],
            ['course_id' => 18, 'view_name' => 'front.cdl-test-course'],
            ['course_id' => 19, 'view_name' => 'front.cdl-dispatcher'],
        ];

        foreach ($templates as $template) {
            DB::table('course_view_templates')->updateOrInsert(
                ['course_id' => $template['course_id']],
                [
                    'view_name' => $template['view_name'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
