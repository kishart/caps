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
   .main{
         background-color: #f8f9fa;
         padding: 20px;
         border-radius: 10px;
   } 
</style>

<body>
    <div class="main">

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
                
                <!-- Check if photoPaths exists and is an array -->
                @if (is_array($photoPaths) && count($photoPaths) > 0)
                    <div id="carousel-{{ $photo->id }}" class="carousel slide mb-5" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Iterate through each photo path for the current session -->
                            @foreach ($photoPaths as $index => $photoPath)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"  >
                                    <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100" alt="Uploaded Photo" style="height:350px; height:300px;">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $photo->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $photo->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <p>No photos available for this upload.</p>
                @endif

               <!-- Display the description associated with the uploaded photos -->
               <p>{{ $photo->description }}</p>

               

               <!-- Comments Section -->
               <h3>Comments:</h3>
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
                   <textarea name="comment" placeholder="Write your comment..."></textarea>
                   <button type="submit">Submit Comment</button>
               </form>
           @else
               <!-- If the authenticated user is not the selected user, display a message -->
               <p><strong>Only {{ $photo->user->username }} can comment on this photo.</strong></p>
           @endif
           
           @endforeach
       @endif
   </div>

   <!-- Include Bootstrap JS and dependencies -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection