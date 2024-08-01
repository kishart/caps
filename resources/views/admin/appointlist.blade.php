@extends('layouts.adminsidebar')

@section('content')


<style>
    .containera{
        margin-top: 30px;
        margin-left: 25%;
        margin-right: 25px;

    }

</style>
    <div class="containera" >
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
                                <a href="{{ url('admin/accepted/'.$appointment->id) }}" class="btn btn-success">Approve</a>
                                <a href="{{ url('admin/declined/'.$appointment->id) }}" class="btn btn-warning">Decline</a>
                                
                                <a href="{{ url('admin/editappoint/'.$appointment->id) }}">
                                    
                                    <span class="material-symbols-outlined">edit_note</span>
                                </a>
                                
                                <a href="{{ url('admin/delete-appointment/'.$appointment->id) }}"><span class="material-symbols-outlined">
                                    delete
                                    </span></a>
                              
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection