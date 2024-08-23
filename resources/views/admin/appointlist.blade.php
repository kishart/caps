@extends('layouts.adminsidebar')

@section('content')
    <style>
        .containera {
            margin-top: 30px;
            margin-left: 25%;
            margin-right: 25px;
        }

        .material-symbols-outlined {
            font-size: 35px;
        }
    </style>

    <div class="containera">
        <div class="row">
            <div class="col-md-12">
                <h2>List of Appointments</h2>

                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $appointment->fname }}</td>
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phone }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->time }}</td>
                                <td>{{ $appointment->details }}</td>
                                <td>{{ ucfirst($appointment->status) }}

                                    <select id="actionSelect" class="custom-select" onchange="handleSelectChange(this)">
                                        <option value="" disabled selected>Select Action</option>
                                        <option value="{{ url('admin/accepted/' . $appointment->id) }}">Approve</option>
                                        <option value="{{ url('admin/declined/' . $appointment->id) }}">Decline</option>
                                    </select>
                                </td>
                                <td>
                                    <form action="{{ route('request.feedback', $appointment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Request Feedback</button>
                                    </form>
                                </td>
                                
                                
                                
                                <td style="white-space: nowrap;">
                                    <a href="{{ url('admin/editappoint/' . $appointment->id) }}" style="margin-right: 10px;">
                                        <span class="material-symbols-outlined" style="color: #ac6f53;">edit_note</span>
                                    </a>
                                
                                    <a href="{{ url('admin/delete-appointment/' . $appointment->id) }}">
                                        <span class="material-symbols-outlined" style="color: red;">delete</span>
                                    </a>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function handleSelectChange(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedValue = selectedOption.value;

            if (selectedValue) {
                // Update the text of the selected option
                selectElement.options[0].text = selectedOption.text;
                selectElement.options[0].disabled = false;

                // Redirect to the selected URL
                window.location.href = selectedValue;
            }
        }
    </script>
@endsection
