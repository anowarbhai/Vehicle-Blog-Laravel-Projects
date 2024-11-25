<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminTermsController extends Controller
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
        $data = DB::table('terms')->first();
        return view('admin.pages.terms', compact('data'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|array',
        ]);

        // Update the post directly in the database
        DB::table('terms')  // Replace 'posts' with your actual table name
            ->where('id', $id)
            ->update([
                'name' => $validatedData['title'],
                'description' => $validatedData['description'],
                'meta_title' => $validatedData['meta_title'],
                'meta_desc' => $validatedData['meta_desc'],
                'meta_keywords' => implode(", ", $validatedData['meta_keywords']),
                'updated_at' => now(),  // Set the updated_at timestamp if applicable
            ]);

        // Redirect back with success message
        return redirect()->route('admin.pages.terms')->with('success', 'Post updated successfully.');
    }

}
