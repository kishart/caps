<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, $appointmentId)
    {
        $request->validate([
            'payment_method' => 'required|in:gcash,in_person',
            'gcash_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_date' => 'nullable|date',
            'payment_time' => 'nullable|date_format:H:i',
            'payment_details' => 'nullable|string|max:255',
        ]);
    
        $imagePath = null;
    
        if ($request->payment_method == 'gcash' && $request->hasFile('gcash_image')) {
            $imagePath = $request->file('gcash_image')->store('gcash_images', 'public');
            Payment::create([
                'appointment_id' => $appointmentId,
                'payment_method' => 'gcash',
                'gcash_image' => $imagePath,
            ]);
        }
    
        if ($request->payment_method == 'in_person') {
            Payment::create([
                'appointment_id' => $appointmentId,
                'payment_method' => 'in_person',
                'payment_date' => $request->payment_date,
                'payment_time' => $request->payment_time,
                'payment_details' => $request->payment_details,
            ]);
        }
    
        return redirect()->back()->with('success', 'Payment information has been saved.');
    }
    

    public function payment($appointmentId)
    {
        $payments = Payment::where('appointment_id', $appointmentId)->get();
        return view('admin.ahome', compact('payments'));
    }
    
    

}
