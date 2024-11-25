<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $categoryid = Category::where('slug', $slug)->firstOrFail();
        
        $blogs = Blog::where('status', 1)->where('category_id', $categoryid->id)->paginate(4);
        $category = Category::all();
        $latest_post = Blog::where('status', 1)->latest()->limit(5)->get();
       
        return view('blogs.category', compact('blogs', 'category', 'latest_post')); // Return a view with the blog posts

    }

}