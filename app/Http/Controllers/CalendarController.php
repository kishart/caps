<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function calendar(){
        $events = array();
        $bookings = Booking::all();
        foreach ($bookings as $booking){
            $events[] = [
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date
            ];
        }
        return view('admin.calendar', ['events' => $events]);
        
    }

    public function addBooking(){
        return view('admin/calendar');
    }

    public function saveBooking(Request $request){
            $request->validate([
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',

                
            ]);

            $title= $request->title;
            $start_date= $request->start_date;
            $end_date= $request->end_date;

            $calen = new Booking();
            $calen->title = $title;
            $calen->start_date = $start_date;
            $calen->end_date = $end_date;
           
            $calen->save();

            return redirect()->back()->with('success', 'booking added successfully');
    }
}
