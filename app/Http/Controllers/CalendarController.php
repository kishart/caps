<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    
    public function calendar(){
        $events = array();
        $calendars = Calendar::all();
        foreach ($calendars as $calendar){
            $events[] = [
                'available' => $calendar->available, // 'available' => 'yes
                'note' => $calendar->note,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
                'start_time' => $calendar->start_time,
                'end_time' => $calendar->end_time
            ];
            
        }
        return view('admin.calendar', ['events' => $events]);
        
    }

    public function addCalendar(){
        return view('admin/calendar');
    }

    public function saveCalendar(Request $request)
    {
        $calendar = new Calendar();
        $start_time = Carbon::parse($request->start_time)->format('h:i A');
        $end_time = Carbon::parse($request->end_time)->format('h:i A');

        $request->validate([
            'available' => 'required',
            'note' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after_or_equal:start_time',
        ]);
        
        $calendar = new Calendar();
        $calendar->available = $request->available;
        $calendar->note = $request->note;
        $calendar->start_date = $request->start_date;
        $calendar->end_date = $request->end_date;
        $calendar->start_time = $request->start_time;
        $calendar->end_time = $request->end_time;
        $calendar->save();
        
        return redirect()->back()->with('success', 'Calendar event added successfully.');
    }
    



    public function ucalen(){
        $events = array();
        $calendars = Calendar::all();
    
        foreach ($calendars as $calendar) {
            // Convert start_time and end_time to 12-hour AM/PM format using Carbon
            $start_time = Carbon::parse($calendar->start_time)->format('h:i A');
            $end_time = Carbon::parse($calendar->end_time)->format('h:i A');
    
            $events[] = [
                'available' => $calendar->available,  // 'available' => 'yes'
                'note' => $calendar->note,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
                'start_time' => $start_time,  // Converted start time
                'end_time' => $end_time,      // Converted end time
            ];
        }
    
        return view('user.ucalen', ['events' => $events]);
    }
    public function schedulelist()
    {
        $events = [];
        $calendars = Calendar::all();
    
        foreach ($calendars as $calendar) {
            $events[] = [
                'id' => $calendar->id,                 // Add the ID for edit and delete actions
                'available' => $calendar->available,   // Availability status
                'note' => $calendar->note,             // Any note or additional information
                'start' => $calendar->start_date,      // Start date of the event
                'end' => $calendar->end_date,          // End date of the event
                'start_time' => Carbon::parse($calendar->start_time)->format('h:i A'), // Start time
                'end_time' => Carbon::parse($calendar->end_time)->format('h:i A'),     // End time
            ];
        }
    
        return view('admin.schedulelist', compact('events'));
    }
    



    public function editcalendar($id)
    {
        $schedule = Calendar::findOrFail($id);
        return view('admin.edit-calendar', compact('schedule'));
    }

    public function updateCalendar(Request $request, $id)
    {
        $request->validate([
            'available' => 'required',
            'note' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
    
        $schedule = Calendar::findOrFail($id);
        $schedule->update($request->all());
    
        return redirect()->route('admin.schedulelist')->with('success', 'Schedule updated successfully.');
    }
    

    public function destroy($id)
    {
        $schedule = Calendar::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedulelist')->with('success', 'Schedule deleted successfully.');
    }

}