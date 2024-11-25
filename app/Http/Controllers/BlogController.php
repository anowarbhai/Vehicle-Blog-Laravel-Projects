<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)->paginate(4); // Retrieve all blog posts
        $category = Category::all();
        $latest_post = Blog::latest()->limit(5)->get();
        
        return view('blogs.index', compact('blogs', 'category', 'latest_post')); // Return a view with the blog posts
    }

    public function details($slug)
    {
        $blog = Blog::where('status', 1)->where('slug', $slug)->limit(4)->firstOrFail();
        $category = Category::all();
        $latest_post = Blog::where('status', 1)->latest()->limit(5)->get();
        $relatedpost = Blog::where('status', 1)->where('category_id', $blog->category_id)->where('id', '!=', $blog->id)->latest()->limit(5)->get();

        
        $blog->increment('view');
            
       
        return view('blogs.details', compact('blog', 'category', 'latest_post', 'relatedpost')); // Return a view with the blog posts

    }

    public function search (Request $request){
        $request->validate([
        'query' => 'required|string|max: 25'
        ]);
        // Retrieve the search query from the request 
        $query = $request->input('query');
        // Search for blog posts that match the query
        $blogs = Blog::where ('title', 'LIKE', "%{$query}%")
                    ->orwhere('description', 'LIKE', "%{$query}%")
                    ->paginate(4); // Adjust the number of items per page as needed
        // Retrieve latest posts and categories (optional)
        $latest_post = Blog::latest()->limit(5)->get();
        $category = Category::all();
        // Return the search results to the view
        return view('blogs.search', compact('blogs', 'latest_post', 'category', 'query'));
    }
}