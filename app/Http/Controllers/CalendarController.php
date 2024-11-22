<?php
namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Display all calendar events for the admin
    public function calendar()
    {
        $events = Calendar::all()->map(function ($calendar) {
            return [
                'available' => $calendar->available,  // 'yes' or 'no'
                'note' => $calendar->note,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
            ];
        });

        return view('admin.calendar', compact('events'));
    }

    // Show the form to add a new calendar event
    public function addCalendar()
    {
        return view('admin.calendar');
    }

    // Save a new calendar event
    public function saveCalendar(Request $request)
    {
        $request->validate([
            'available' => 'required',
            'note' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end date is not before start date
        ]);

        $calen = new Calendar();
        $calen->available = $request->available;
        $calen->note = $request->note;
        $calen->start_date = $request->start_date;
        $calen->end_date = $request->end_date;
        $calen->save();

        return redirect()->back()->with('success', 'Calendar event added successfully.');
    }

    // Display all calendar events for the user
    public function ucalen()
    {
        $events = Calendar::all()->map(function ($calendar) {
            return [
                'available' => $calendar->available,  // 'yes' or 'no'
                'note' => $calendar->note,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
            ];
        });

        return view('user.ucalen', compact('events'));
    }
}
