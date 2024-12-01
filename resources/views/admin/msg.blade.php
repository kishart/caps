@extends('layouts.adminsidebar')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="{{ asset('css/msg.css') }}">
</head>

<body>
    <div class="containera">
        <!-- Left Side (Form for Message Details or Placeholder Text) -->
        <div class="left" id="detailsContainer">
            <p id="placeholderText"><strong>Select a message to view details.</strong></p>
            <form id="detailsForm" style="display: none;">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" readonly></textarea>
                </div>
            </form>
        </div>

        <!-- Right Side (Message List) -->
        <div class="right">
            <p style=" font-size: 20px;
    font-weight: bold;">Messages</p>
            @foreach($contacts as $contact)
                <div class="list" 
                     data-name="{{ $contact->user->name }}" 
                     data-subject="{{ $contact->subject }}" 
                     data-message="{{ $contact->message }}">
                    <ion-icon name="person-circle" style="font-size: 50px;"></ion-icon>
                    <div class="infomessage">
                        <p><strong>{{ $contact->user->name }}</strong></p>
                        <p>{{ $contact->subject }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const messageElements = document.querySelectorAll('.list');
            const placeholderText = document.getElementById('placeholderText');
            const detailsForm = document.getElementById('detailsForm');

            // Add click event to each message element
            messageElements.forEach((element) => {
                element.addEventListener('click', () => {
                    const name = element.getAttribute('data-name');
                    const subject = element.getAttribute('data-subject');
                    const message = element.getAttribute('data-message');

                    // Hide placeholder and show form
                    placeholderText.style.display = 'none';
                    detailsForm.style.display = 'block';

                    // Populate the form with the message details
                    document.getElementById('name').value = name;
                    document.getElementById('subject').value = subject;
                    document.getElementById('message').value = message;
                });
            });
        });
    </script>
</body>
@endsection
