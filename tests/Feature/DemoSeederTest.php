<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Course;
use App\Models\SiteSetting;
use Database\Seeders\DemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_seeder_builds_the_catalog_with_landing_template_ids(): void
    {
        $this->seed(DemoSeeder::class);
        $this->seed(DemoSeeder::class);

        $this->assertSame(range(9, 19), Course::whereBetween('id', [9, 19])->orderBy('id')->pluck('id')->all());
        $this->get('/courses')->assertOk()->assertSee('CDL Canada: Drive in the USA');
        $this->get('/courses-details/cdl-canada')->assertOk();
    }

    public function test_admin_dashboard_renders_without_site_settings(): void
    {
        $this->assertSame(0, SiteSetting::count());
        $admin = Admin::create(['name' => 'Admin', 'email' => 'a@example.com', 'password' => bcrypt('password')]);

        $this->actingAs($admin, 'admin')->get('/admin/dashboard')->assertOk();
    }
}
