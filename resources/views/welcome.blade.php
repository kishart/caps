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
</style>
@extends('layouts.welcome')
@section('content')
<div class="container">
    <div class="column">
        <img src="{{ asset('images/Logo.png') }}" alt="logo">

    </div>

                <div class="column">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h1>Husnie Photography</h1>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror @error('email') is-invalid @enderror
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
    </div>
</div>
@endsection

<!--
tempo
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <div class="hero">
  <div class="form-box">
  <div class="button-box">
    <div id="btn"></div>
    <button type="button" class="toggle-btn" onclick="login()">Log In</button>
    <button type="button" class="toggle-btn" onclick="register()">Register</button>
    </div>
   
    <form id="login" class="input-group">
      <input type="text" class="input-field" placeholder="User Id" required>
      <input type="text" class="input-field" placeholder="Enter Password" required>
 
      <button type="submit" class="submit-btn">Log In</button>
         </form>
    
     <form id="register" class="input-group">
      <input type="text" class="input-field" placeholder="User Id" required>
       <input type="text" class="input-field" placeholder="Email Id" required>
      <input type="text" class="input-field" placeholder="Enter Password" required>
       
 
      <button type="submit" class="submit-btn">Log In</button>
         </form>
    </div>
    
    </div>
</body>
</html>



*{
  margin:0;
  padding:0;
}
.hero{
  height:100%;
  width: 100%;
  background-color:pink;
  background-position:center;
  background-size:cover;
  position:absolute;
}
.form-box{
   width:380px;
  height:480px;
  position:relative;
  margin:6% auto;
  background:#fff;
  padding:5px;
  overflow:hidden;
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
.input-group{
  top:180px;
  position:absolute;
  width:280px;
  transition: .5s;
}
.input-field{
  width:100%;
  padding:10px 0;
  margin:5px 0;
  border-left:0;
  border-top:0;
  border-right:0;
  border-bottom:1px solid #999;
  outline:none;
  background:transparent;
}

.submit-btn{
  width:85%;
  padding: 10px 30px;
  cursor:pointer;
  display:block;
  margin:auto;
  background: linear-gradient(to right, #ff105f, #ffad06);
  border:0;
  outline:none;
  border-radius:30px;  
}

#login{
  left:50px;
}
#register{
  left:450px;
}

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

-->
