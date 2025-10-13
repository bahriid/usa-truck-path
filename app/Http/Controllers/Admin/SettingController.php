<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
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
        ]);
        


 
        
        // Get the first site setting or create a new one if it doesn't exist
        $setting = SiteSetting::first();
    
        if (!$setting) {
            $setting = SiteSetting::create([]);
        }
    
        // Delete old images if new ones are uploaded
        if ($request->hasFile('main_logo') && $setting->main_logo) {
            Storage::disk('public')->delete($setting->main_logo);
        }
    
        if ($request->hasFile('sticky_logo') && $setting->sticky_logo) {
            Storage::disk('public')->delete($setting->sticky_logo);
        }
    
        if ($request->hasFile('footer_logo') && $setting->footer_logo) {
            Storage::disk('public')->delete($setting->footer_logo);
        }
    
        if ($request->hasFile('site_favicon') && $setting->site_favicon) {
            Storage::disk('public')->delete($setting->site_favicon);
        }
    
        // Update the site setting values
        $setting->update($validated);
    
        // Handle logo uploads and store them
        if ($request->hasFile('main_logo')) {
       

            $setting->main_logo = $request->file('main_logo')->store('logos', 'public');
            // dd($request->all());    
        }
    
        if ($request->hasFile('sticky_logo')) {
            $setting->sticky_logo = $request->file('sticky_logo')->store('logos', 'public');
        }
    
        if ($request->hasFile('footer_logo')) {
            $setting->footer_logo = $request->file('footer_logo')->store('logos', 'public');
        }
    
        if ($request->hasFile('site_favicon')) {
            $setting->site_favicon = $request->file('site_favicon')->store('favicons', 'public');
        }
    
        $setting->save();
    
        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }
    
}
