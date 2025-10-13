<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    // Show the form to edit legal pages
    public function index()
    {
        // Assuming only one record exists (id=1)
        $legal = LegalPage::first();
        return view('admin.legal.index', compact('legal'));
    }

    // Update the legal pages
    public function update(Request $request)
    {
        $request->validate([
            'privacy_policy'      => 'nullable|string',
            'terms_and_conditions'=> 'nullable|string',
        ]);

        $legal = LegalPage::first();
        $legal->update([
            'privacy_policy'       => $request->privacy_policy,
            'terms_and_conditions' => $request->terms_and_conditions,
        ]);

        return redirect()->back()->with('success', 'Legal pages updated successfully.');
    }
}
