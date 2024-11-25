<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate the request
        $validator = validator::make($request->all(), Subscriber::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the subscriber
        Subscriber::create($request->only('email'));

        // Redirect with a success message
        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}
