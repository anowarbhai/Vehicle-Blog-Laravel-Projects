<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Settings; // Assuming you have a Settings model
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
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
        $settings = DB::table('settings')->first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'sitename' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fav_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',
        ]);

        // Retrieve the current settings
        $settings = Settings::first(); // Assuming you have only one settings record

        // Update the settings
        $settings->site_name = $request->sitename;
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->facebook = $request->facebook;
        $settings->instagram = $request->instagram;
        $settings->youtube = $request->youtube;
        $settings->twitter = $request->twitter;
        $settings->meta_title = $request->meta_title;
        $settings->meta_desc = $request->meta_desc;
        $settings->meta_keyword = $request->meta_keyword;
        $settings->copyright = $request->copyright;

        // Handle file uploads
        if ($request->hasFile('logo')) {
            // Delete old image if exists
            if ($settings->logo && file_exists(public_path($settings->logo))) {
                unlink(public_path($settings->logo));
            }

            // Save the new image
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/settings'), $filename);
            $settings->logo = '/assets/images/settings/' . $filename;
        }

        // Handle file uploads
        if ($request->hasFile('fav_icon')) {
            // Delete old image if exists
            if ($settings->fav_icon && file_exists(public_path($settings->fav_icon))) {
                unlink(public_path($settings->fav_icon));
            }

            // Save the new image
            $file = $request->file('fav_icon');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/settings'), $filename);
            $settings->fav_icon = '/assets/images/settings/' . $filename;
        }

        // Save the updated settings
        $settings->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

}
