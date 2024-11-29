<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messages</title>
</head>
<body>
    <div>
        @if($messages->isEmpty())
            <p>No messages yet.</p>
        @else
            <ul>
                @foreach($messages as $message)
                    <li>{{ $message->message }} (Sent on: {{ $message->created_at }})</li>
                @endforeach
            </ul>
        @endif
    
        <form method="POST" action="{{ route('send.message', $appointment->id) }}">
            @csrf
            <textarea name="message" placeholder="Write your message here..." required></textarea>
            <button type="submit">Send Message</button>
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
</body>
</html>
