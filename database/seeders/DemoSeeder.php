<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\SiteSetting;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * Portfolio demo data: the full course catalog (ids 9-19 match the landing templates),
 * chapters with slide videos and readings, students with enrollments in every state.
 * Re-runnable and Faker-free. Run: php artisan db:seed --class=DemoSeeder --force
 */
class DemoSeeder extends Seeder
{
    /** @var array<int, array{0: string, 1: string, 2: string, 3: float, 4: string, 5: string, 6?: string}> id => title, slug, category, price, course_type, curriculum kind, language (free intro 20 comes before the language courses that point to it) */
    private const COURSES = [
        1 => ['Trucking in the USA: Free Starter Course', 'trucking-in-the-usa-free-starter', 'Free Course', 0, 'tier', 'starter'],
        20 => ['Commercial Learner\'s Permit (CLP) - Free Intro', 'commercial-learners-permit-clp-free', 'CLP Course', 0, 'language_selector', 'clp'],
        9 => ['Commercial Learner\'s Permit (CLP) - English', 'commercial-learners-permit-clp-english', 'CDL Permit', 297, 'paid', 'clp', 'en'],
        10 => ['Commercial Learner\'s Permit (CLP) - Arabic', 'commercial-learners-permit-clp-arabic', 'CDL Permit', 297, 'paid', 'clp', 'ar'],
        11 => ['Commercial Learner\'s Permit (CLP) - Amharic', 'commercial-learners-permit-clp-amharic', 'CDL Permit', 297, 'paid', 'clp', 'am'],
        12 => ['Commercial Learner\'s Permit (CLP) - French', 'commercial-learners-permit-clp-french', 'CDL Permit', 297, 'paid', 'clp', 'fr'],
        13 => ['Commercial Learner\'s Permit (CLP) - Nepali', 'commercial-learners-permit-clp-nepali', 'CDL Permit', 297, 'paid', 'clp', 'ne'],
        14 => ['Commercial Learner\'s Permit (CLP) - Somali', 'commercial-learners-permit-clp-somali', 'CDL Permit', 297, 'paid', 'clp', 'so'],
        15 => ['CDL Canada: Drive in the USA', 'cdl-canada', 'CDL Canada', 497, 'paid', 'abroad'],
        16 => ['CDL Europe: Drive in the USA', 'cdl-europe', 'CDL Europe', 497, 'paid', 'abroad'],
        17 => ['CDL Global: Drive in the USA', 'cdl-global', 'CDL Global', 497, 'paid', 'abroad'],
        18 => ['CDL Test Prep: Pass the First Time', 'cdl-test-course', 'CDL Test', 197, 'paid', 'test'],
        19 => ['Truck Dispatcher Training', 'cdl-dispatcher', 'Dispatcher', 397, 'paid', 'dispatch'],
    ];

    /** @var array<string, string> reading title => body */
    private const READINGS = [
        'Who this course is for' => 'Drivers abroad who want a U.S. trucking career, people already in the U.S. who want a better-paid job, and anyone confused by visas, CLP and CDL. No trucking experience needed.',
        'Cost Breakdown & Financial Planning' => 'Plan for the CLP fee ($40 to $100 by state), DOT medical exam ($75 to $150), CDL school ($3,000 to $8,000, or $0 with company-paid training), skills test ($100 to $350) and 2 to 3 months of living costs.',
        'Your 90-day action plan' => 'Weeks 1-2: documents and medical card. Weeks 3-4: CLP written tests. Weeks 5-10: training and backing practice. Weeks 11-12: skills test, then apply to 10 carriers in one week.',
        'Documents you need' => 'Valid ID or passport, proof of state residency (two documents), Social Security number, DOT medical card, and the CLP application form from your state DMV.',
        'Practice questions: General Knowledge' => '1. How often should you check your mirrors? Every 5 to 8 seconds. 2. What is the most important reason to inspect your vehicle? Safety. 3. Following distance at 50 mph for a 40-foot truck? 5 seconds.',
        'Final checklist before test day' => 'Sleep well, bring your ID, medical card and glasses if you need them. Read every answer before choosing. Flag hard questions and come back to them.',
        'Converting your driving experience' => 'U.S. carriers count verifiable commercial experience from abroad when it is documented: letters from previous employers, logbooks and a clean driving record translated to English.',
        'Choosing a CDL school' => 'Ask for the pass rate, hours behind the wheel (not just classroom), job placement partners, and whether a carrier will reimburse the tuition after you are hired.',
        'Your first 90 days on the road' => 'Expect a trainer for 4 to 8 weeks, then solo runs. Track your miles and pay, keep your logs clean, and talk to dispatch early when something goes wrong.',
        '100 practice questions' => 'A full question bank organized by topic: inspection, control, shifting, seeing, communicating, space, speed, night driving, hazards, emergencies and cargo.',
        'Air brake practice questions' => 'The air compressor governor cuts out around 125 psi. The low pressure warning must come on before 60 psi. Spring brakes come on between 20 and 45 psi.',
        'Pre-trip script you can memorize' => 'Engine compartment: fluids, belts, hoses. Cab: gauges, horn, wipers, mirrors. External: lights, tires, wheels, suspension, brakes. Coupling: fifth wheel, kingpin, air and electric lines.',
        'Industry terms you will hear daily' => 'Deadhead, rate con, BOL, POD, detention, lumper, TONU, reefer, dry van, flatbed, broker, shipper, consignee.',
        'Contracts and invoicing templates' => 'A dispatch service agreement, carrier packet checklist, and an invoice template with load number, rate confirmation and POD attached.',
    ];

    /** @var array<int, array{0: string, 1: string, 2: string, 3: array<int, array{0: int, 1: string, 2: string}>}> name, email, country, [[course id, status, tier]] */
    private const STUDENTS = [
        ['Daniel Mensah', 'student@usatruckpath.com', 'Ghana', [[1, 'approved', 'premium'], [9, 'approved', 'premium'], [15, 'pending', 'premium']]],
        ['Emeka Okafor', 'emeka@usatruckpath.com', 'Nigeria', [[1, 'approved', 'premium'], [17, 'approved', 'premium']]],
        ['Ramesh Adhikari', 'ramesh@usatruckpath.com', 'Nepal', [[20, 'approved', 'free'], [13, 'approved', 'premium']]],
        ['Mike Ward', 'mike@usatruckpath.com', 'Canada', [[1, 'approved', 'free'], [15, 'approved', 'premium']]],
        ['Ahmed Hassan', 'ahmed@usatruckpath.com', 'Egypt', [[20, 'approved', 'free'], [10, 'pending', 'premium']]],
        ['Lukas Novak', 'lukas@usatruckpath.com', 'Czech Republic', [[16, 'pending', 'premium']]],
        ['Fatima Yusuf', 'fatima@usatruckpath.com', 'Somalia', [[20, 'approved', 'free'], [14, 'approved', 'premium']]],
        ['Carlos Mendez', 'carlos@usatruckpath.com', 'United States', [[18, 'approved', 'premium'], [19, 'pending', 'premium']]],
        ['Sophie Martin', 'sophie@usatruckpath.com', 'France', [[12, 'rejected', 'premium']]],
    ];

    public function run(): void
    {
        Model::unguard();
        $curriculum = require __DIR__.'/demo-curriculum.php';

        Schema::disableForeignKeyConstraints();
        foreach (['course_user', 'topics', 'chapters', 'course_view_templates', 'courses'] as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
        User::where('email', 'like', '%@usatruckpath.com')->delete();

        foreach (File::files(public_path('demo/videos')) as $file) {
            Storage::disk('public')->put('demo/videos/'.$file->getFilename(), File::get($file->getPathname()));
        }

        foreach (self::COURSES as $id => [$title, $slug, $category, $price, $type, $kind]) {
            $language = self::COURSES[$id][6] ?? null;
            $course = Course::create([
                'id' => $id,
                'parent_course_id' => $language ? 20 : null,
                'title' => $title,
                'menu_name' => $title,
                'slug' => $slug,
                'category' => $category,
                'short_description' => $this->shortDescription($kind),
                'description' => '<p>'.$this->shortDescription($kind).'</p>',
                'price' => $price,
                'original_price' => $price > 0 ? $price + 200 : null,
                'premium_price' => $type === 'tier' ? 97 : 0,
                'mentorship_price' => $type === 'tier' ? 497 : 0,
                'course_type' => $type,
                'language' => $language,
                'is_free' => $price == 0,
                'status' => 'active',
                'is_active' => true,
                'coming_soon' => false,
                'order' => $id,
            ]);

            foreach ($curriculum[$kind] as $chapterTitle => $topics) {
                $chapter = Chapter::create(['course_id' => $course->id, 'title' => $chapterTitle, 'order' => $course->chapters()->count() + 1]);
                foreach ($topics as [$topicType, $tier, $topicTitle, $video, $bullets]) {
                    Topic::create([
                        'chapter_id' => $chapter->id,
                        'type' => $topicType,
                        'tier' => $tier,
                        'title' => $topicTitle,
                        'duration' => $topicType === 'video' ? '0:12' : '5 min read',
                        'source_from' => $video ? 'local' : null,
                        'local_video' => $video ? "demo/videos/{$video}.mp4" : null,
                        'description' => $video
                            ? '<ul><li>'.implode('</li><li>', $bullets).'</li></ul>'
                            : '<p>'.(self::READINGS[$topicTitle] ?? '').'</p>',
                    ]);
                }
            }
        }

        $this->call(CourseViewTemplateSeeder::class);

        SiteSetting::firstOrCreate([], [
            'site_title' => 'USATruckPath',
            'site_description' => 'Your bridge to U.S. trucking: free courses, CLP prep in 6 languages and mentorship.',
            'contact_email' => 'support@usatruckpath.com',
            'contact_phone' => '+1 (555) 010-2030',
            'whatsapp_no' => '+15550102030',
            'address' => 'Dallas, TX',
            'geo_filtering_enabled' => false,
        ]);

        Admin::updateOrCreate(['email' => 'admin@example.com'], ['name' => 'Admin', 'password' => Hash::make('password')]);

        foreach (self::STUDENTS as $i => [$name, $email, $country, $enrollments]) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'country' => $country,
                'phone' => '+1 555 01'.str_pad((string) $i, 2, '0', STR_PAD_LEFT),
                'email_verified_at' => now(),
            ]);

            foreach ($enrollments as $n => [$courseId, $status, $tier]) {
                $course = Course::find($courseId);
                $paid = $tier === 'free' ? 0 : ($course->course_type === 'tier' ? 97 : $course->price);
                $at = now()->subDays(40 - $i * 4 - $n);
                DB::table('course_user')->insert([
                    'course_id' => $courseId,
                    'user_id' => $user->id,
                    'full_name' => $name,
                    'email' => $email,
                    'phone' => $user->phone,
                    'country' => $country,
                    'status' => $status,
                    'subscription_tier' => $tier,
                    'transaction_amount' => $paid,
                    'transaction_id' => $paid > 0 ? 'pi_demo_'.$user->id.'_'.$courseId : null,
                    'created_at' => $at,
                    'updated_at' => $at,
                ]);
            }
        }

        Model::reguard();
    }

    private function shortDescription(string $kind): string
    {
        return match ($kind) {
            'starter' => 'Understand the U.S. trucking industry, the visa options and the CDL process before you spend a dollar.',
            'clp' => 'Pass your Commercial Learner\'s Permit tests with video lessons, audio guides and real DMV practice questions in your language.',
            'abroad' => 'A step-by-step path for experienced drivers abroad: work options, licensing in the U.S., and getting hired by a carrier.',
            'test' => 'Focused prep for the CDL written tests and the pre-trip inspection, with practice questions for every section.',
            'dispatch' => 'Learn to dispatch trucks from home: load boards, rate negotiation, broker relations and running your own dispatch business.',
        };
    }
}
