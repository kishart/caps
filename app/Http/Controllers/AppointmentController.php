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

}