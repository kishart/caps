@extends('layouts.adminsidebar')

@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Message</title>
        <style>
            .containera {
                display: flex;
                padding: 10px;
            }

            .left {
                flex: 3;
                /* 60% width */
                background: #e8e8e8;
                padding: 20px;
                height: 95vh;
                overflow-y: auto;
                border-radius: 10px;
            }

            .right {
                flex: 2;
                /* 40% width */
                background: #d8d8d8;
                padding: 20px;
                height: 95vh;
                overflow-y: auto;
                border-radius: 10px;
            }

            .list {
                background-color: black;
                display: flex;
                padding: 10px;
                border-radius: 10px;
                margin-top: 5px;
                color: white;
                cursor: pointer;
                align-items: center;
            }

            .infomessage {
                padding-left: 10px;
            }

            .list:hover {
                background-color: #333;
            }
        </style>
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
