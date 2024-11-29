@extends('layouts.nav')

@section('content')
    <style>
        div {

            font-family: "Jost", sans-serif;
        }
        
footer {
    margin-top: 50px;
    text-align: center; /* Centers the content inside the footer */
    padding: 20px;
    background-color: #000000; /* Optional: Set your desired background color */
}

.footerp {
    font-size: 25px;
    margin-bottom: 0 10px;/* Adds spacing between the text and icons */
    color:rgb(238, 204, 140); /* Optional: Adjust text color */
}

.footericon {
    display: flex;
    justify-content: center; /* Centers the icons horizontally */
    gap: 15px; /* Adds space between the icons */
}

.footericon a ion-icon {
    font-size: 24px; /* Adjust icon size */
    color:rgb(238, 204, 140);
    text-decoration: none;
}

.footericon a:hover {
    color: #0077b5; /* Change icon color on hover */
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
    <style>

    </style>
@endsection
