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

        // Initialize image path for later assignment
        $imagePath = null;

        // Store Gcash payment
        if ($request->payment_method == 'gcash') {
            if ($request->hasFile('gcash_image')) {
                // Store the uploaded image
                $imagePath = $request->file('gcash_image')->store('gcash_images', 'public');
            }

            // Store the payment record
            Payment::create([
                'appointment_id' => $appointmentId,
                'payment_method' => 'gcash',
                'gcash_image' => $imagePath,  // This will be null if no image was uploaded
            ]);
        }

        // Store Payment in Person
        if ($request->payment_method == 'in_person') {
            // Validate the in-person payment details
            Payment::create([
                'appointment_id' => $appointmentId,
                'payment_method' => 'in_person',
                'payment_date' => $request->payment_date,
                'payment_time' => $request->payment_time,
                'payment_details' => $request->payment_details,
            ]);
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Payment information has been saved.');
    }
}
