<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminBlogsController extends Controller
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
        $blogs = Blog::orderBy('created_at', 'desc')->get();; // Retrieve all blog posts
        // dd($blogs);
        return view('admin.blogs.index', compact('blogs'));
    }

    
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.blogs.create', compact('categories', 'users'));
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $post = Blog::find($id);
        $categories = Category::all();
        $users = User::all();
        return view('admin.blogs.edit', compact('post', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'posttitle' => 'required|string|max:255',
            'postslug' => 'required|string|max:255',
            'postcategory' => 'required|exists:categories,id',
            'postauthor' => 'required|exists:users,id',
            'desc' => 'required|string',
            'postimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'metatitle' => 'nullable|string|max:255',
            'metadescription' => 'nullable|string',
            'meta_keyword' => 'nullable|array',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create the post
            $post = new Blog();
            $post->title = $request->posttitle;

            $slug = $request->postslug;
            $slugUniqueCheck = Blog::where('slug', $slug)->count();
            if($slugUniqueCheck > 0){
                $post->slug = $request->postslug.'-'.rand(1, 999);
            }else{
                $post->slug = $request->postslug;
            }

            $post->category_id = $request->postcategory;
            $post->user_id = $request->postauthor;
            $post->description = $request->desc;
            $post->meta_title = $request->metatitle;
            $post->meta_desc = $request->metadescription;
            $post->status = $request->status;
            if ($request->has('meta_keyword')) {
                $post->meta_keyword = implode(", ", $request->meta_keyword);
            }

            // Handle the image upload if it exists
            if ($request->hasFile('postimage')) {
                $file = $request->file('postimage');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/blogs'), $filename);
                $post->image = '/assets/images/blogs/'.$filename;
            }

            $post->save();

            return redirect()->route('admin.blogs.create')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            // Log the error (optional)
            \Log::error('Error creating post: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the post.'])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // Fetch the post by ID
        $post = Blog::findOrFail($id);

        // Validate the incoming data
        $validatedData = $request->validate([
            'posttitle' => 'required|string|max:255',
            'postcategory' => 'required|exists:categories,id',
            'postauthor' => 'required|exists:users,id',
            'desc' => 'required|string',
            'postimage' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validate image
            'metatitle' => 'nullable|string|max:255',
            'metadescription' => 'nullable|string|max:1000',
            'meta_keyword' => 'nullable|array',
            'status' => 'required',
        ]);

        // Update the post data
        $post->title = $validatedData['posttitle'];
        $post->category_id = $validatedData['postcategory'];
        $post->user_id = $validatedData['postauthor'];
        $post->description = $validatedData['desc'];
        $post->meta_title = $validatedData['metatitle'] ?? null;
        $post->meta_desc = $validatedData['metadescription'] ?? null;
        $post->status = $validatedData['status'];
        $post->meta_keyword = implode(',', $validatedData['meta_keyword']);

        // Handle the image upload if it exists
        if ($request->hasFile('postimage')) {
            // Delete old image if exists
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            // Save the new image
            $file = $request->file('postimage');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/blogs'), $filename);
            $post->image = '/assets/images/blogs/' . $filename;
        }

        // Save the post
        $post->save();

        // Redirect with success message
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        // Fetch the post by ID
        $post = Blog::findOrFail($id);

        // Check if the post has an associated image
        if ($post->image && file_exists(public_path($post->image))) {
            // Delete the image file from public directory
            unlink(public_path($post->image));
        }

        // Delete the post from the database
        $post->delete();

        // Redirect with success message
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
