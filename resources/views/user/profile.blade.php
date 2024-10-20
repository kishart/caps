@extends('layouts.nav')

@section('content')
<div class="container">
    <h2>Your Profile</h2>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" 
            value="{{ old('name') }}" 
			pattern="^[a-zA-Z\s]+$" 
			title="Name should only contain letters and spaces" 
			required autocomplete="name" autofocus>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
        value="{{ Auth::user()->email }}" 
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
        title="Please enter a valid email address (e.g., user@example.com)." 
        required autocomplete="email" autofocus>

    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" placeholder="Username" type="text" class="form-control @error('username') is-invalid @enderror" 
                name="username" 
                value="{{ Auth::user()->username }}" 
                pattern="^[a-zA-Z0-9_]+$" 
                title="Username should only contain letters, numbers, or underscores. No spaces or special characters allowed." 
                required autocomplete="username" autofocus>
            
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}" 
                pattern="^09\d{9}$" 
                title="Phone number must start with 09 and be followed by 9 digits" 
                required>
            <div id="phone-error" style="color:red; display:none;">Phone number must start with 09 and be followed by 9 digits.</div>
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        
        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
    </form>
</div>
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