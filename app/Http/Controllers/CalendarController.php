<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function calendar(){
        $events = array();
        $calendars = Calendar::all();
        foreach ($calendars as $calendar){
            $events[] = [
                'available' => $calendar->available, // 'available' => 'yes
                'title' => $calendar->title,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date
            ];
        }
        return view('admin.calendar', ['events' => $events]);
        
    }

    public function addCalendar(){
        return view('admin/calendar');
    }

    public function saveCalendar(Request $request){
            $request->validate([
                'available' => 'required',
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',

                
            ]);
            $available= $request->available;

            $title= $request->title;
            $start_date= $request->start_date;
            $end_date= $request->end_date;

            $calen = new Calendar();
            $calen->available = $available;
            $calen->title = $title;
            $calen->start_date = $start_date;
            $calen->end_date = $end_date;
           
            $calen->save();

            return redirect()->back()->with('success', 'calendar added successfully');
    }
}
