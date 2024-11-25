<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class AdminContactController extends Controller
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
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.pages.contact', compact('contacts'));
    }
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('admin.pages.show', compact('contact'));
    }

    public function destroy($id)
    {
        // Fetch the post by ID
        $contact = Contact::findOrFail($id);

        // Delete the post from the database
        $contact->delete();

        // Redirect with success message
        return redirect()->route('admin.pages.contact')->with('success', 'Contact deleted successfully.');
    }
}
