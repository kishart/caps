@extends('layouts.app')

@section('content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col-md-12">
                <h2>List of Appointments</h2>
               
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Approved</th>
                            <th>Canceled</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     @php
					 $i = 1;
					 @endphp
					 @foreach ($appointments as $appointment)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$appointment->fname}}</td>
							<td>{{$appointment->email}}</td>
							<td>{{$appointment->phone}}</td>
							<td>{{$appointment->date}}</td>
							<td>{{$appointment->time}}</td>
							<td>{{$appointment->details}}</td>
							<td>{{$appointment->status}}</td>
							<td>
								@if($appointment->approved == 1)
								<span class="text-success">Approved</span>
								@else
								<span class="text-danger">Not Approved</span>
								@endif
							</td>
							<td>
								@if($appointment->canceled == 1)
								<span class="text-danger">Canceled</span>
								@else
								<span class="text-success">Not Canceled</span>
								@endif
							</td>
							<td>
								<a href="{{url('admin/editappoint/'.$appointment->id)}}" class="btn btn-primary">Edit</a>
								<a href="{{url('user/delete-booking/'.$appointment->id)}}" class="btn btn-danger">Delete</a>
							</td>
						</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
