@extends('layouts.nav')
@section('title', 'Contact Us')
@section('content')
    <style>

       
        div {

            font-family: "Jost", sans-serif;
            margin-bottom: 30px;
        }
        




.allrights{
    text-align: center;
    color: white;
}
    </style>



    @if(session('success'))
    <div style="color: green; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

    <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 70vh; ">
        <div
            style="display: flex; width: 80%; background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <!-- Left Side: Contact Form -->
            <div class="contact-form" style="flex: 3; padding: 20px; background: #fafafa;">
                <h2 style="margin-bottom: 20px; color: #333;">Contact Us</h2>
                <form action="{{ route('contact.store') }}" method="POST" style="display: flex; flex-direction: column;">
                 
                    @csrf <!-- Add CSRF token for security -->
                    <p>Subject</p>
                    <input type="text" name="subject" required placeholder="Subject"
                        style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                    <p>Message</p>
                    <textarea name="message" required placeholder="Message"
                        style=" font-family: Jost, sans-serif;  margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; height: 100px;"></textarea>
                    <button type="submit"
                        style="padding: 10px; background-color: #A36361; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Send
                        Message</button>
                </form>
            </div>

            <!-- Right Side: Contact Info -->
        <div class="contact-info"
     style="padding: 30px; 
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
        
        </div>
    </div>

    @include('layouts.footer')
    

    <style>

    </style>
@endsection
