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
