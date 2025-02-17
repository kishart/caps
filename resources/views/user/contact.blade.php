@extends('layouts.nav')
@section('title', 'Contact Us')
@section('content')
    <style>

        .allrights {
            text-align: center;
            color: white;
       
        }
        .contain {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 20vh;
        }
        .contact-form {
        max-width: 520px;
        align-content: center;
        justify-content: center;
    }
    .contact-info{
        height: 64vh;
    }

        /* For responsiveness maclab */
        @media (width: 2240px) {
            .contact-form {
        max-width: 820px;
        align-content: center;
        justify-content: center;
    }
    .contact-info{
        height: 34vh;
    }

        }
    </style>


@if(session('success'))
<script>
    window.onload = function() {
        alert("{{ session('success') }}");
    };
</script>
@endif

    <div class="contain" style="display: flex; justify-content: center; align-items: center; min-height: 70vh; ">
        {{-- <div
            style="display: flex; width: 80%; background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden;"> --}}
            <!-- Left Side: Contact Form -->
            <div class="contact-form" style="flex: 3; padding: 20px; background: #fafafa;">
                <h2 style="margin-bottom: 20px; color: #333;">Contact Us</h2>
                <!-- <form action="{{ route('contact.store') }}" method="POST" style="display: flex; flex-direction: column;"> -->
                <form action="{{ route('sendemail.send') }}" method="POST" style="display: flex; flex-direction: column;">
               
                    @csrf <!-- Add CSRF token for security -->
                    <p>Name</p>
                    <input type="text" name="name" required placeholder="Name"
                        style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                    
                    <p>Email</p>
                    <input type="text" name="email" required placeholder="Email"
                        style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                    <p>Message</p>
                    <textarea name="message" required placeholder="Message"
                        style="resize:none; font-family: Jost, sans-serif;  margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; height: 100px;"></textarea>
                    <button type="submit"
                        style="padding: 10px; background-color: #A36361; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Send
                        Message</button>
                </form>
            </div>

            <!-- Right Side: Contact Info -->
            <div class="contact-info" style="padding: 30px; 
           background-color:#E8B298;">
                <p style="font-size: 40px; ">Let's get in touch</p>
                <p style="font-size: 20px; ">We're open for any suggestion or just to have chat</p>

                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <ion-icon name="mail" style="font-size: 40px; color: #000;"></ion-icon>
                        <p style="margin: 0;">husnie.photography@gmail.com</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <ion-icon name="call" style="font-size: 40px; color: #000;"></ion-icon>
                        <p style="margin: 0;">09123456789</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <ion-icon name="logo-facebook" style="font-size: 40px; color: #000;"></ion-icon>
                        <p style="margin: 0;">facebook.com/husniephotography</p>
                    </div>
                </div>


            </div>
{{-- 
        </div> --}}
    </div>

    @include('layouts.footer')


    <style>

    </style>
@endsection
