<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Create the contact message
    Contact::create([
        'user_id' => auth()->id(), // Associate the contact with the authenticated user
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    // Redirect back with a success message
    return back()->with('success', 'Your message has been sent successfully.');
}
public function msgview()
{
    $contacts = Contact::with('user')
        ->orderBy('created_at', 'desc') // Order by latest first
        ->get();

    return view('admin.msg', compact('contacts'));
}


    
}
