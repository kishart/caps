@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Photos</title>
    <!-- Add Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .main {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }

    .comment textarea {
        width: 100%;
        margin-top: 10px;
    }
    img{
        height: 400px; /* Adjust the height as needed */
    max-width: 70%; /* Set max-width as a percentage of the parent container */
    object-fit: cover; /* Ensures the image covers the set height without stretching */
    border-radius: 10px; /* Keep the border-radius */
    margin: 0 auto; /* Center the image horizontally */
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%; /* Reduce button width */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); /* Add background color to icons for better visibility */
        border-radius: 50%; /* Make the background rounded */
    }

    .carousel .carousel-control-prev,
    .carousel .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
    }

    .carousel .carousel-control-prev {
        left: 15px; /* Position the left button inside the image */
    }

    .carousel .carousel-control-next {
        right: 15px; /* Position the right button inside the image */
    }
  
</style>

<body>
    <div class="main" style="background-color:white;">

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($photoUploads->isEmpty())
            <div class="alert alert-info mt-3">
                No photos uploaded yet.
            </div>
        @else
            <!-- Iterate through each upload session -->
            @foreach ($photoUploads as $photo)
                @php
                    // Decode the JSON-encoded photo paths
                    $photoPaths = json_decode($photo->photo_paths, true);
                @endphp

                <div class="row mb-5" >
                    <!-- Left Column: Photos (70%) -->
                    <div class="col-md-8" >
                        @if (is_array($photoPaths) && count($photoPaths) > 0)
                        <div id="carousel-{{ $photo->id }}" class="carousel slide">
                            <div class="carousel-inner">
                                <!-- Iterate through each photo path for the current session -->
                                @foreach ($photoPaths as $index => $photoPath)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100" alt="Uploaded Photo">
                                    </div>
                                @endforeach
                            </div>
                            <button style=" margin-left: 130px;" class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $photo->id }}" data-bs-slide="prev">
                                <ion-icon name="caret-back-outline" style="font-size: 2rem; background-color: #A36361;"></ion-icon>
                            </button>
                            <button style=" margin-right: 130px;" class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $photo->id }}" data-bs-slide="next">
                                <ion-icon name="caret-forward-outline" style="font-size: 2rem; background-color: #A36361;"></ion-icon>
                            </button>
                            
                        </div>
                        @else
                            <p>No photos available for this upload.</p>
                        @endif

                        <p style="margin-left:140px;margin-right:140px; border-radius:10px; height:70px; margin-top:20px; background-color:#EECC8C " >{{ $photo->description }}</p>
                    </div>

                    <!-- Right Column: Comments (30%) -->
                    <div class="col-md-4" style=" display: flex; justify-content: center; align-items: center;">
                        <div class="comment" style="width: 80%; background-color: #EECC8C; padding: 10px; border-radius: 8px; text-align: center; margin-bottom:70px; height:240px;">
                            <!-- Check if there are any comments associated with the photo -->
                            @if ($photo->comments->where('photo_id', $photo->id)->isEmpty())
                                <p>No comments yet.</p>
                            @else
                                <!-- Display each comment -->
                                @foreach ($photo->comments as $comment)
                                    <p><strong>{{ $comment->user->username }}:</strong> {{ $comment->comment }}</p>
                                @endforeach
                            @endif
                    
                            <!-- Allow commenting if the authenticated user's ID matches the selected user_id for the photo -->
                            @if (Auth::check() && Auth::id() == $photo->user_id)
                                <form action="{{ route('post-comment', $photo->id) }}" method="POST">
                                    @csrf
                                    <textarea name="comment" placeholder="Write your comment..." rows="4" class="form-control"></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                                </form>
                            @else
                                <!-- If the authenticated user is not the selected user, display a message -->
                                <p><strong>Only {{ $photo->user->username }} can comment on this photo.</strong></p>
                            @endif
                        </div>
                    </div>
                    
                </div>
            @endforeach
        @endif
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
