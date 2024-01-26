<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

<style>

.container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .column {
            flex: 1;
            padding: 20px;
            margin: 10px;
        }
        img{
           width: 55%;
           height: 75%;
           margin-left: 12%;
           margin-top: 20%;
           border-radius: 15px; 
        }
        h1{
            margin-left: 20%;
            padding-top: 15%;
            padding-bottom: 5%;
            font-family: 'DM Serif Display', serif;
        }

        #login{
  left:50px;
}
#register{
  left:450px;
}
.button-box{
  width:220px;
  margin:35px auto;
  position:relative;
  box-shadow:0 0 20px 9px #ff61241f;
  border-radius:30px;
}
.toggle-btn{
  padding:10px 30px;
  cursor:pointer;
  background:transparent;
  border:0;
  outline:none;
  position:relative;
}
#btn{
  top:0;
  left:0;
  position:absolute;
  width:110px;
  height:100%;
  background: linear-gradient(to right, #ff105f, #ffad06);
  border-radius: 30px;
  transition: .5s;
}
</style>


@extends('layouts.welcome')
@section('content')
<div class="container">
    <div class="column">
        <img src="{{ asset('images/Logo.png') }}" alt="logo">

    </div>

                <div class="column">
                    <form id="login" method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <h1>Husnie Photography</h1>

                        <div class="button-box">
                            <div id="btn"></div>
                            <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                            <button type="button" class="toggle-btn" onclick="register()">Register</button>
                            </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" @error('username') is-invalid @enderror @error('email') is-invalid @enderror
                                " name="username" value="{{old('username') }}" required autocomplete="username" autofocus>
                                
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" @error('password') is-invalid @enderror" class="input-field" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>


                    <form id="register" method="POST" class="input-group" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" @error('email') is-invalid @enderror" class="input-field" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username"  @error('username') is-invalid @enderror" class="input-field" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" @error('password') is-invalid @enderror" class="input-field" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
</div>

<script>
    var  x = document.getElementById("login");
var  y = document.getElementById("register");
var  z = document.getElementById("btn");

function register(){
  x.style.left = "-400px";
  y.style.left = "50px";
  z.style.left="110px";
}
function login(){
  x.style.left = "50px";
  y.style.left = "450px";
  z.style.left="0";
}
</script>
@endsection

