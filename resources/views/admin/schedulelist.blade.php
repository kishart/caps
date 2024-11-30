@extends('layouts.adminsidebar')

@section('content')
<div class="container mt-4">
    <h1 class="text-xl font-bold mb-4">Schedule List</h1>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Availability</th>
                <th class="border border-gray-300 px-4 py-2">Note</th>
                <th class="border border-gray-300 px-4 py-2">Start Date</th>
                <th class="border border-gray-300 px-4 py-2">End Date</th>
                <th class="border border-gray-300 px-4 py-2">Start Time</th>
                <th class="border border-gray-300 px-4 py-2">End Time</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $event['available'] }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $event['note'] }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $event['start'] }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $event['end'] }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $event['start_time'] }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $event['end_time'] }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('admin.editcalendar', $event['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.schedules.delete', $event['id']) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
