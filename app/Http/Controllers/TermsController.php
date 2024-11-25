<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $content = DB::table('terms')->first();
        $latest_post = Blog::where('status', 1)->latest()->limit(5)->get();
        
        return view('pages.terms', compact('content', 'latest_post')); // Return a view with the blog posts
    }
}
