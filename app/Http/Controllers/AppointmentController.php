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
   
    public function archived()
{
    $archivedAppointments = Appointment::where('status', 'archived')->get();
    return view('admin.archived', compact('archivedAppointments'));
}

    public function moveToArchived(Request $request)
{
    $ids = $request->input('ids');
    
    if ($ids) {
        // Update appointments' status to archived
        Appointment::whereIn('id', $ids)->update(['status' => 'archived']);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'No IDs provided.']);
}



    public function saveAppoint(Request $request)
    {
        $data = new Appointment;
        $data->fname = $request->fname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->details = $request->details;
        $data->status = 'In Progress';
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        } else {
            $data->user_id = 0;
        }
        $data->save();

        return redirect()->back()->with('success', 'Booking added successfully');
    }

    

    public function editAppointment($id)
    {
        $data = Appointment::where('id', '=', $id)->first();
        return view('admin/editappoint', compact('data'));
    }

    public function updatePaymentMethod(Request $request, $appointmentId)
{
    $request->validate([
        'payment_method' => 'required|in:gcash,in_person',
    ]);

    $appointment = Appointment::findOrFail($appointmentId);
    $appointment->payment_method = $request->payment_method;
    $appointment->save();

    return redirect()->route('viewpayment', ['appointmentId' => $appointmentId])
                     ->with('success', 'Payment method updated successfully!');
}

    public function updateAppointment(Request $request)
    {
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

    public function deleteAppointment($id)
    {
        Appointment::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully');
    }

    public function profile()
    {
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $book = Appointment::where('user_id', $userid)->get();
            return view('user.profile', compact('book'));
        } else {
            return redirect()->back();
        }
    }

    public function cancel_booking($id)
    {
        $data = Appointment::find($id); 
        $data->delete();
        return redirect()->back();
    }
    
  
    
    
    public function accepted(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'downpayment' => 'required|numeric|min:0',
        ]);
    
        // Find the appointment and save the downpayment amount
        $appointment = Appointment::findOrFail($id);
        $appointment->downpayment = $request->downpayment;
        $appointment->status = 'Approved';
        $appointment->save();
    
        return redirect()->back()->with('message', 'Appointment approved and down payment set.');
    }
    
    public function paid($id)
    {
        $data = Appointment::find($id);
        $data->status = "Paid";
        $data->save();
        return redirect()->back()->with('success', 'Appointment paid successfully.');
    }
   

    public function declined($id)
    {
        $data = Appointment::find($id);
        $data->status = "Declined";
        $data->save();
        return redirect()->back()->with('success', 'Appointment declined successfully.');
    }

    public function showDownpayment($id)
    {
        $appointment = Appointment::findOrFail($id);  // Fetch specific appointment
    return view('user.payment', compact('appointment'));
    }

    public function  showUserDownpayment($id)
    {
        $appointment = Appointment::findOrFail($id);  // Fetch specific appointment
        return view('user.payment', compact('appointment'));
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
        $appointment->user_id = Auth::id();

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

        // Check if feedback already exists
        if ($appointment->feedback) {
            return redirect()->back()->with('error', 'You have already submitted feedback for this appointment.');
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

        if ($appointment) {
            // Show the messages for this appointment
            return view('user.messages', compact('appointment'));
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }
    public function adminHome()
    {
        // Fetch all appointments or other data needed for the admin
        $appointments = Appointment::all();

        // Return the admin's home page view with data
        return view('admin.home', compact('appointments'));  // Adjust the view path as needed
    }

    public function storePayment(Request $request, $appointmentId)
    {
        // Validate the input
        $validated = $request->validate([
            'payment_method' => 'required|in:gcash,in_person',
            'gcash_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_details' => 'nullable|string|max:255',
        ]);
    
        // Initialize the image path to null
        $imagePath = null;
    
        // If the GCash image is provided, store it
        if ($request->hasFile('gcash_image')) {
            $imagePath = $request->file('gcash_image')->store('gcash_images', 'public');
        }
    
        // Fetch the existing appointment record
        $appointment = Appointment::findOrFail($appointmentId);
    
        // Update the payment details for the existing appointment
        $appointment->update([
            'payment_method' => $validated['payment_method'],
            'gcash_image' => $imagePath,
            'status' => 'Paid', // Optional: Update the status to 'Paid'
        ]);
    // Redirect to localhost or success page
    return redirect()->back()->with('success', 'Payment submitted successfully!');
    }

    public function viewPayments($appointmentId)
    {
        $payments = Appointment::where('appointment_id', $appointmentId)->with('appointment')->get();

        return view('admin.ahome', compact('payments'));

    }








}