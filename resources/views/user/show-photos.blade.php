@extends('layouts.nav')
@section('title', 'Photos')
@section('content')

<head>
 
    <title>View Photos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/show-photos.css') }}">
</head>


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
                                        <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100 images" alt="Uploaded Photo">
                                    </div>
                                @endforeach
                            </div>
                            <button style=" margin-left: -20px;" class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $photo->id }}" data-bs-slide="prev">
                                <ion-icon name="caret-back-outline" style="font-size: 2rem; color: #000;"></ion-icon>
                            </button>
                            <button style=" margin-right: -20px;" class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $photo->id }}" data-bs-slide="next">
                                <ion-icon name="caret-forward-outline" style="font-size: 2rem; color: #000;"></ion-icon>
                            </button>
                            
                        </div>
                        @else
                            <p>No photos available for this upload.</p>
                        @endif

                        <p class="description" >{{ $photo->description }}</p>
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
                                    <button type="submit" class="subbut btn  mt-2">Submit Comment</button>
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
