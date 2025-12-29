<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Services\FileUploadService;

class SettingController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function site_setting()
    {
        // Get the first site setting (since there's usually only one)
        $setting = SiteSetting::first();
        
        return view('admin.site_settings.site_settings', compact('setting'));
    }

    public function update_site_setting(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'site_title' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string|max:255',
            'main_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sticky_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'facebook_url' => 'nullable|url',
            'whatsapp_no' => 'nullable|numeric|digits_between:10,20',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|numeric|digits_between:10,20',
            'address' => 'nullable|string',
            'cash_app' => 'nullable|string',
            'zelle' => 'nullable|string',
            'geo_filtering_enabled' => 'nullable|boolean',
        ]);

        // Get the first site setting or create a new one if it doesn't exist
        $setting = SiteSetting::first();

        if (!$setting) {
            $setting = SiteSetting::create([]);
        }

        // Update the site setting values
        $setting->update($validated);

        // Handle file uploads using FileUploadService
        $uploadedFiles = $this->fileUploadService->handleMultipleUploads(
            ['main_logo', 'sticky_logo', 'footer_logo', 'site_favicon'],
            $request,
            $setting,
            [
                'main_logo' => 'logos',
                'sticky_logo' => 'logos',
                'footer_logo' => 'logos',
                'site_favicon' => 'favicons',
            ]
        );

        // Update setting with new file paths
        foreach ($uploadedFiles as $field => $path) {
            $setting->$field = $path;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }
    
}
