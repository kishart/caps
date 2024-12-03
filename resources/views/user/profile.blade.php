@extends('layouts.nav')
@section('title', 'Profile')
@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

</head>
<div class="containerp">
    <h2>Your Profile</h2>
    
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ Auth::user()->name }}" 
                   value="{{ old('name') }}" 
                   pattern="^[a-zA-Z\s]+$" 
                   title="Name should only contain letters and spaces" 
                   required autocomplete="name" autofocus>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" 
                   value="{{ Auth::user()->email }}" 
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                   title="Please enter a valid email address (e.g., user@example.com)." 
                   required autocomplete="email" autofocus>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" placeholder="Username" type="text" class="form-control" 
                   name="username" 
                   value="{{ Auth::user()->username }}" 
                   pattern="^[a-zA-Z0-9_]+$" 
                   title="Username should only contain letters, numbers, or underscores. No spaces or special characters allowed." 
                   required autocomplete="username" autofocus>
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" 
                   value="{{ Auth::user()->phone }}" 
                   pattern="^09\d{9}$" 
                   title="Phone number must start with 09 and be followed by 9 digits" 
                   required>
            <div id="phone-error" class="error-message">Phone number must start with 09 and be followed by 9 digits.</div>
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">
            Update Profile
        </button>
    </form>
</div>


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
@endsection

<script>
document.getElementById('phone').addEventListener('input', function() {
    const phoneInput = this;
    const phoneError = document.getElementById('phone-error');
    
    const phonePattern = /^09\d{9}$/; // 09 followed by 9 digits
    if (!phonePattern.test(phoneInput.value)) {
        phoneError.style.display = 'block';
    } else {
        phoneError.style.display = 'none';
    }
});
</script>
