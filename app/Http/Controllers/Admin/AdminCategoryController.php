<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AdminCategoryController extends Controller
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
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.category.create');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'categoryname' => 'required|string|max:255',
            'categoryslug' => 'required|string|max:255',
            'desc' => 'required|string',
            'postimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'meta_keyword' => 'nullable|array',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        

        try {
            // Create the post
            $post = new Category();
            $post->title = $request->categoryname;

            $slug = $request->categoryslug;
            $slugUniqueCheck = Category::where('slug', $slug)->count();
            if($slugUniqueCheck > 0){
                $post->slug = $request->categoryslug.'-'.rand(1, 999);
            }else{
                $post->slug = $request->categoryslug;
            }
            $userId = Auth::id();
            $post->user_id = $userId;
            $post->description = $request->desc;
            $post->meta_title = $request->meta_title;
            $post->meta_desc = $request->meta_desc;
            if ($request->has('meta_keyword')) {
                $post->meta_keyword = implode(", ", $request->meta_keyword);
            }

            // dd($request->file('postimage'));
            // Handle the image upload if it exists
            if ($request->hasFile('postimage')) {
                $file = $request->file('postimage');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/categories'), $filename);
                $post->image = '/assets/images/categories/'.$filename;
            }

            $post->save();

            return redirect()->route('admin.category.create')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            // Log the error (optional)
            \Log::error('Error creating post: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the post.'])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Validate the request data
        $request->validate([
            'categoryname' => 'required|string|max:255',
            'desc'         => 'nullable|string',
            'postimage'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title'   => 'nullable|string|max:255',
            'meta_desc'    => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|array',
        ]);

        // Update category details
        $category->title = $request->input('categoryname');
        $category->description = $request->input('desc');
        $category->meta_title = $request->input('meta_title');
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keyword = implode(',', $request->input('meta_keyword', []));

        // Handle the image upload if provided
        if ($request->hasFile('postimage')) {
            // Delete old image if it exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $file = $request->file('postimage');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/categories'), $filename);

            $category->image = 'assets/images/categories/' . $filename;
        }

        // Save the updated category
        $category->save();

        // Redirect back with success message
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        // Fetch the post by ID
        $category = Category::findOrFail($id);

        // Check if the post has an associated image
        if ($category->image && file_exists(public_path($category->image))) {
            // Delete the image file from public directory
            unlink(public_path($category->image));
        }

        // Delete the post from the database
        $category->delete();

        // Redirect with success message
        return redirect()->route('admin.category.index')->with('success', 'Category post deleted successfully.');
    }


}
