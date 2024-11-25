<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $latest_post = Blog::where('status', 1)->latest()->limit(5)->get();
        return view('pages.contact', compact('latest_post')); // Return a view with the blog posts
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Store the subscriber in the database
        Contact::create($request->all());
        // Redirect with a success message
        return redirect()->route('pages.contact')->with('success', 'Message Sent successfully!');
    }
}