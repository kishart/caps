@extends('layouts.adminsidebar')

@section('content')
<!-- Include the Schedule List specific CSS -->
<link href="{{ asset('css/schedulelist.css') }}" rel="stylesheet">
@section('title', 'Schedule List')
{{-- <div class="containera mt-4"> --}}
    <h1 class="text-xl font-bold mb-4">Schedule List</h1>
    <table class="schedule-table">
        <thead>
            <tr>
                <th>Availability</th>
                <th>Note</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event['available'] }}</td>
                <td>{{ $event['note'] }}</td>
                <td>{{ $event['start'] }}</td>
                <td>{{ $event['end'] }}</td>
                <td>{{ $event['start_time'] }}</td>
                <td>{{ $event['end_time'] }}</td>
                <td class="schedule-actions">
                    <a href="{{ route('admin.editcalendar', $event['id']) }}" class="schedule-btn-edit">Edit</a>
                    <form action="{{ route('admin.schedules.delete', $event['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="schedule-btn-delete" 
                                onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
