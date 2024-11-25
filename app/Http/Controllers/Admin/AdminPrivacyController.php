<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminPrivacyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('privacy')->first();
        return view('admin.pages.privacy', compact('data'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request
    $validatedData = $request->validate([
        'sitename'       => 'required|string|max:255',
        'phone'          => 'nullable|string|max:15',
        'email'          => 'nullable|email|max:255',
        'address'        => 'nullable|string|max:255',
        'facebook'       => 'nullable|url|max:255',
        'instagram'      => 'nullable|url|max:255',
        'youtube'        => 'nullable|url|max:255',
        'twitter'        => 'nullable|url|max:255',
        'meta_title'     => 'nullable|string|max:255',
        'meta_desc'      => 'nullable|string|max:500',
        'meta_keywords'  => 'nullable|string|max:255',
        'copyright'      => 'nullable|string|max:255',
        'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'favicon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:2048',
    ]);

    // Update each setting in the database
    foreach ($validatedData as $key => $value) {
        if ($request->hasFile($key)) {
            // Handle file uploads
            $file = $request->file($key);
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/settings'), $filename);
            $value = '/assets/images/settings/' . $filename;
        }

        DB::table('settings')->update(
            ['key' => $key], // Check by key
            ['value' => $value, 'updated_at' => now()] // Update value and timestamp
        );
    }

    return redirect()->back()->with('success', 'Settings updated successfully.');
    }

}
