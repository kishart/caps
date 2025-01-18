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
            min-height: 70vh;
        }

        .contact-form {
            max-width: 520px;
            align-content: center;
            justify-content: center;
            flex: 3;
            padding: 20px;
            background: #fafafa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-info {
            flex: 2;
            padding: 30px;
            background-color: #E8B298;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 2240px) {
            .contact-form {
                max-width: 820px;
            }

            .contact-info {
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

    <div class="contain">
        <div class="contact-form">
            <h2 style="margin-bottom: 20px; color: #333;">Contact Us</h2>
            <form action="{{ route('sendemail.send') }}" method="POST" style="display: flex; flex-direction: column;">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Enter Message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Let's Get in Touch</h3>
            <p>We're open for any suggestion or just to have a chat.</p>
            <ul style="list-style: none; padding: 0;">
                <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <ion-icon name="mail" style="font-size: 24px; margin-right: 10px;"></ion-icon>
                    husnie.photography@gmail.com
                </li>
                <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <ion-icon name="call" style="font-size: 24px; margin-right: 10px;"></ion-icon>
                    09123456789
                </li>
                <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <ion-icon name="logo-facebook" style="font-size: 24px; margin-right: 10px;"></ion-icon>
                    facebook.com/husniephotography
                </li>
            </ul>
        </div>
    </div>

    @include('layouts.footer')
@endsection
