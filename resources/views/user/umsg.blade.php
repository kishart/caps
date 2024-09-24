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
</body>
</html>
