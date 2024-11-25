<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Models\Blog;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {   
        $content = DB::table('privacy')->first();
        $latest_post = Blog::where('status', 1)->latest()->limit(5)->get();
        return view('pages.privacy', compact('content', 'latest_post')); // Return a view with the blog posts
    }
}