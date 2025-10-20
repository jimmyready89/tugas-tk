<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    /**
     * Display the company profile.
     */
    public function show()
    {
        $profile = CompanyProfile::getDefault();
        
        return view('company.profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the company profile.
     */
    public function edit()
    {
        $profile = CompanyProfile::getDefault();
        
        return view('company.profile.edit', compact('profile'));
    }

    /**
     * Update the company profile in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'comp_name' => 'required|string|max:255',
            'comp_description' => 'nullable|string',
            'comp_email' => 'nullable|email|max:255',
            'comp_telephone' => 'nullable|string|max:20',
            'comp_address' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
        ]);

        $profile = CompanyProfile::getDefault();
        
        $profile->update([
            'comp_name' => $request->comp_name,
            'comp_description' => $request->comp_description,
            'comp_email' => $request->comp_email,
            'comp_telephone' => $request->comp_telephone,
            'comp_address' => $request->comp_address,
            'vision' => $request->vision,
            'mission' => $request->mission,
        ]);

        return redirect()->route('company.profile.show')
                        ->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}
