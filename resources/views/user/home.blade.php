@extends('layouts.app')

@section('content')
<div class="flex h-[100px] ">
    <div class="w-3/5 p-4"> <!-- Left Column (60%) -->
        <p style="margin-top:10%;" class=" mx-4 text-6xl font-bold">Capture great moments with better quality.</p>
        <p>Husnie Photography</p>

        <div style="margin-top:10%; margin-left:120px;">
            <button class="bg-black text-white p-5  rounded-full" style="margin-right: 30px;">
                <a href="{{ asset('setap') }}">Set Appointment</a>
            </button>
            <button class="bg-black text-white p-5 rounded-full ">
                <a href="{{ asset('ucalen') }}">Check Calendar</a>
            </button>
            
        </div>
    </div>
    <div class="w-2/5 p-4"> 
        <img src="{{ asset('images/husnie.png') }}" alt="logo">
        
    </div>
</div>

@endsection
