@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text">
            <h2>Husnie Photography</h2>
            <p>“The camera is an instrument that teaches people how to see without a camera.” <br>– Dorothea Lange.</p>

            <div class="wrapper">
                <a href="#demo-modal">Set an Appointment</a>

                <div id="demo-modal" class="modal">
                    <div class="modal__content">
                        <h1>Set an Appointment</h1>
                        <input type="text" placeholder="Name">
                        <input type="text" placeholder="Email">
                        <input type="text" placeholder='Phone'>
                        <input type="date" placeholder="Date">
                        <input type="text" placeholder="Time">
                        <input type="text" placeholder="Message">
                        <button>Submit</button>
                        <a href="#" class="modal__close">&times;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="image">
            <img src="https://demos.bakerwebdev.net/undertone/wp-content/uploads/sites/19/elementor/thumbs/image-of-smiling-beautiful-woman-using-laptop-whil-QN9VYGM-p4ksje7poi87foeareuxijrvt0kaek9oo9kmh9r1mw.jpg"
                alt="Your Image">
        </div>
    </div>
@endsection
