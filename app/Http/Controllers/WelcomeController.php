<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->limit(4)->get(); // Retrieve all blog posts
        $category = Category::all();
        $latest_post = Blog::where('status', 1)->latest()->limit(5)->get();
        return view('welcome', compact('blogs', 'category', 'latest_post')); // Return a view with the blog posts
    }
}
