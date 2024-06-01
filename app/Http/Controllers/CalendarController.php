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
}
