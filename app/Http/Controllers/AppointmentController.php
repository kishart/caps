<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function setap()
    {
        return view('user.setap');
    }

    public function saveAppoint(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'details' => 'required'
        ]);

        Appointment::create([
            'fname' => $request->fname,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'details' => $request->details,
            'status' => 'In progress',
            'user_id' => $request->user_id // Make sure to handle this field if necessary
        ]);

        return redirect()->back()->with('success', 'Booking added successfully');
    }
    public function saveAppointment(Request $request) {
        // Validate and save the appointment...
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'You have successfully set an appointment');
    }
    
    
}
