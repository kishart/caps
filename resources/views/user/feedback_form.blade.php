@extends('layouts.nav')

@section('content')
@section('title', 'Feedback Form')
<div class="container">
    <h2>Feedback for Appointment on {{ $appointment->date }}</h2>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display error message if feedback already submitted -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Check if feedback already exists -->
    @if ($appointment->feedback)
        <div class="alert alert-info">
            You have already submitted feedback for this appointment.
        </div>
        <button class="btn btn-secondary mt-3" disabled>Feedback Submitted</button>
    @else
        <form action="{{ route('submit.feedback', $appointment->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="feedback">Your Feedback</label>
                <textarea name="feedback" id="feedback" rows="5" class="form-control" placeholder="Enter your feedback here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Feedback</button>
        </form>
    @endif
</div>
@endsection



<footer>
    <p class="footerp">Husnie Photography</p>
    <p style="color:white; font-size:12px;">Lorem ipsum dolor, sit amet consectetur adipisicing elit.  possimus nam mollitia dolorum amet.
        <br>Laboriosam exercitatione molestiae sint consectetur facere nobis possimus nam mollitia dolorum amet? 
          </p>
    <div class="footericon">
        <a href="https://www.facebook.com/HusniePhotography" target="_blank">
            <ion-icon name="logo-facebook"></ion-icon>
        </a>
        <a href="https://www.instagram.com/husnie_photography?igsh=NzF0eXQxZG1uOG0=" target="_blank">
            <ion-icon name="logo-instagram"></ion-icon>
        </a>
       
        <a href="mailto:itshusnie@gmail.com">
            <ion-icon name="mail"></ion-icon>
        </a>
    </div>
<div class="footerf">
    <p class="allrights">© 2024 Husnie Photography. All rights reserved.</p>
</div>
  
</footer>

