<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class UpdateBannerSlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first existing slider's image or use a default
        $existingSlider = Slider::first();
        $defaultImage = $existingSlider ? $existingSlider->image : 'sliders/default-banner.jpg';

        // Delete existing sliders
        Slider::truncate();

        // Banner Slide 1
        Slider::create([
            'title' => 'Global Drivers Welcome',
            'subtitle' => 'Full Journey Support from Visa Application to Job Placement + Lifetime Mentorship',
            'image' => $defaultImage,
            'is_active' => 1,
            'redirect_url' => null,
        ]);

        // Banner Slide 2
        Slider::create([
            'title' => 'Owner-Operator Success Blueprint',
            'subtitle' => 'Master Your Business, Dispatching & Freight Brokerage + Lifetime Mentorship',
            'image' => $defaultImage,
            'is_active' => 1,
            'redirect_url' => null,
        ]);

        // Banner Slide 3
        Slider::create([
            'title' => 'Complete Training & Lifetime Mentorship',
            'subtitle' => 'Complete training from visa application to getting hired, plus lifetime mentorship in our private Telegram community—all included',
            'image' => $defaultImage,
            'is_active' => 1,
            'redirect_url' => null,
        ]);

        $this->command->info('Banner sliders updated successfully!');
    }
}
