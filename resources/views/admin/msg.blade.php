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
            
            <!-- Left Side (60%) -->
            <div class="left" id="detailsContainer">
                
                <p><strong>Select a message to view details.</strong></p>
            </div>

            <!-- Right Side (40%) -->
            <div class="right">
                @foreach($contacts as $contact)
                    <div class="list" 
                         onclick="showDetails('{{ $contact->user->name }}', '{{ $contact->subject }}', '{{ $contact->message }}')">
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
            function showDetails(name, subject, message) {
                const detailsContainer = document.getElementById('detailsContainer');
                detailsContainer.innerHTML = `
                    <p><strong>Name:</strong> ${name}</p>
                    <p><strong>Subject:</strong> ${subject}</p>
                    <p><strong>Message:</strong> ${message}</p>
                `;
            }
        </script>
    </body>
@endsection
