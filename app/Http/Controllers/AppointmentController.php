<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

use App\Models\Message;
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



   public function accepted(Request $request, $id)
   {
       // Validate the downpayment input
       $request->validate([
           'downpayment' => 'required|numeric|min:0',
       ]);
   
       // Find the appointment by its ID
       $appointment = Appointment::find($id);
   
       if ($appointment) {
           // Save the downpayment and change the status to 'approved'
           $appointment->downpayment = $request->input('downpayment');
           $appointment->status = 'approved';
           $appointment->save();
   
           // Redirect to some success page or show success message
           return redirect()->back()->with('success', 'Appointment approved and downpayment saved.');
       }
   
       return redirect()->back()->with('error', 'Appointment not found.');
   }
   
   public function showPaymentPage($id)
   {
       $appointment = Appointment::find($id);
   
       if ($appointment) {
           // Pass the downpayment amount to the view
           return view('user.payment', ['downpaymentAmount' => $appointment->downpayment]);
       }
   
       return redirect()->back()->with('error', 'Appointment not found.');
   }
   
   

public function declined($id) {
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



public function sendMessage(Request $request, $appointmentId)
{
    // Validate the request
    $request->validate([
        'message' => 'required|string|max:255',
    ]);

    // Find the appointment
    $appointment = Appointment::find($appointmentId);

    if ($appointment) {
        // Create a new message linked to the appointment
        $message = new Message();
        $message->appointment_id = $appointment->id;
        $message->message = $request->input('message'); 
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully.');
    } else {
        return redirect()->back()->with('error', 'Appointment not found.');
    }
}


    // Method to retrieve messages for a specific appointment
    public function getMessages($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        $messages = $appointment->messages; // Retrieve associated messages

        return view('user.messages', compact('appointment', 'messages')); // Display in a view
    }

    public function showMessages($appointment_id)
    {
        // Fetch the appointment by ID
        $appointment = Appointment::find($appointment_id);
    
        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
    
        // Get all messages associated with the appointment
        $messages = $appointment->messages;
    
        // Return the view and pass the appointment and its messages
        return view('user.messages', compact('appointment', 'messages'));

        $appointments = Appointment::with('message')->get();

    }
    

}