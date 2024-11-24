<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'fname' => 'required|string|max:255',
            'user_id' => auth()->id(), // Associate the contact with the authenticated user
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully.');
    }
    public function msgview()
    {
        $contacts = Contact::with('user')->get(); // Eager-load user relationship
        return view('admin.msg', compact('contacts'));
    }
    

    
}
