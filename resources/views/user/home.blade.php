@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text">
            <h2>Husnie Photography</h2>
            <p>“The camera is an instrument that teaches people how to see without a camera.” <br>– Dorothea Lange.</p>

            <div class="wrapper">
                <a  href="{{ asset('setap') }}">Set an Appointment</a>


            </div>
        </div>

        <div class="image">
            <img src="https://demos.bakerwebdev.net/undertone/wp-content/uploads/sites/19/elementor/thumbs/image-of-smiling-beautiful-woman-using-laptop-whil-QN9VYGM-p4ksje7poi87foeareuxijrvt0kaek9oo9kmh9r1mw.jpg"
                alt="Your Image">
        </div>
    </div>
@endsection
