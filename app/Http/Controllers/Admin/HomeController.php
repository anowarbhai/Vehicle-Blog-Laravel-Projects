<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
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
        $blogs = Blog::orderBy('created_at', 'desc')->limit(5)->get(); // Retrieve all blog posts
        $totalPosts = Blog::count(); // Retrieve total number of posts
        $totalDraftPosts = Blog::where('status', 0)->count(); // Retrieve total number of posts
        $totalPublishedPosts = Blog::where('status', 1)->count(); // Retrieve total number of posts
        $totalCategories = Category::count(); // Retrieve total number of categories
        $categories = Category::limit(5)->get();
        $totalContacts = Contact::count();
        return view('admin.dashboard', compact('blogs', 'totalPosts', 'totalCategories', 'categories', 'totalContacts', 'totalDraftPosts', 'totalPublishedPosts'));
    }
}
