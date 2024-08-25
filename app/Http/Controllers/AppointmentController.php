<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function setap()
    {
        return view('user.setap');
    }

    public function saveAppoint(Request $request)
    {
        $data = new appointment;
        $data->fname = $request->fname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->details = $request->details;
        $data->status = 'In Progress';
        if(Auth::id()){
            $data->user_id = Auth::user()->id;
        }
        else{
            $data->user_id = 0;
        }
        $data->save();
        $data->feedback = $request->feedback;
        return redirect()->back()->with('success', 'Booking added successfully');
    }

    public function appointlist()
    {
        $appointments = Appointment::all();
        return view('admin.appointlist', compact('appointments'));
    }

    public function editAppointment($id){
        $data = Appointment::where('id','=',$id)->first();
        return view('admin/editappoint', compact('data'));
    }
    
    public function updateAppointment(Request $request){
        $request->validate([
            'fname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'details' => 'required'
        ]);
    
        $id = $request->id;
        $fname = $request->fname;
        $email = $request->email;
        $phone = $request->phone;
        $date = $request->date;
        $time = $request->time;
        $details = $request->details;
    
        Appointment::where('id', '=', $id)->update([
            'fname' => $fname,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'time' => $time,
            'details' => $details
        ]);
    
        return redirect()->back()->with('success', 'Booking updated successfully');
    }
    
    public function deleteAppointment($id){
        Appointment::where('id', '=', $id)->delete();
         return redirect()->back()->with('success', 'booking deleted successfully');
   
   }
   public function profile(){
       if(Auth::id()){
           $userid=Auth::user()->id;
           $book=Appointment::where('user_id', $userid)->get();
       return view('user.profile', compact('book'));
       }
       else{
           return redirect()->back();
       }
       
   }
   public function cancel_booking($id){
       $data=booking::find($id);
       $data->delete();
       return redirect()->back();

   }



   public function accepted($id){
    $data = Appointment::find($id);
    $data->status = "Approved";
    $data->save();
    return redirect()->back()->with('success', 'Appointment approved successfully.');
}

public function declined($id){
    $data = Appointment::find($id);
    $data->status = "Declined";
    $data->save();
    return redirect()->back()->with('success', 'Appointment declined successfully.');
}







    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'details' => 'required|string',
        ]);

        $appointment = new Appointment;
        $appointment->fname = auth()->user()->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->details = $request->details;
        $appointment->status = 'Pending';
        $appointment->user_id = Auth::id(); // Associate appointment with the logged-in user

        $appointment->save();

        return redirect()->back()->with('success', 'Appointment has been successfully created.');
    }

    // Display user's appointments
    public function myappoint()
    {
        if (Auth::check()) {
            $userid = Auth::id();
            $appointments = Appointment::where('user_id', $userid)->get();
            return view('user.myappoint', compact('appointments'));
        } else {
            return redirect()->route('login')->with('error', 'You need to log in to view your appointments.');
        }

    }

    
    public function payment()
    {
        return view('user.payment');
    }


    public function requestFeedback($id)
{
    $appointment = Appointment::find($id);
    $appointment->feedback_requested = true;
    $appointment->save();

    return redirect()->back()->with('success', 'Feedback request sent successfully.');
}



public function showFeedbackForm($id)
{
    $appointment = Appointment::find($id);
    return view('user.feedback_form', compact('appointment'));
}


public function submitFeedback(Request $request, $id)
{
    $appointment = Appointment::find($id);

    if (!$appointment) {
        return redirect()->back()->with('error', 'Appointment not found.');
    }

    $appointment->feedback = $request->feedback;
    $appointment->save();

    return redirect()->back()->with('success', 'Thank you for your feedback.');
}

public function getFeedback($id)
{
    $appointment = Appointment::find($id);
    if (!$appointment) {
        return response()->json(['error' => 'Appointment not found'], 404);
    }

    // Assuming feedback is stored in a field called `feedback`
    $feedback = $appointment->feedback ?? 'No feedback provided yet.';

    return response()->json(['feedback' => $feedback]);
}

}