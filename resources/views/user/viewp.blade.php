<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Photos</title>
    <link rel="stylesheet" href="{{ asset('css/viewp.css') }}">
</head>
<body>
    <div class="container">
        <h1>Uploaded Files</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="file-list">
            @if($files->isEmpty())
                <p>No files uploaded yet.</p>
            @else
@endif


@foreach($files as $file)
    <div class="file-item">
        <!-- Display the photo -->
        <img src="{{ asset('uploads/photos/' . $file->filename) }}" alt="{{ $file->description }}" />

        <!-- Display the description -->
        <p>{{ $file->description }}</p>

        <!-- Display the user who uploaded the file -->
        <p>Uploaded by: {{ $file->user->name }}</p>

        <!-- Display the associated post's category (if available) -->
        @if($file->post)
            <p>Category: {{ $file->post->category }}</p>
        @endif
    </div>
@endforeach

    <!-- Display file details and comments -->
    {{-- @foreach($files as $file) <!-- Loop through files -->

    <div class="file">
        <p>Uploaded by: {{ $file->user->username }}</p>
        <p>Description: {{ $file->description }}</p>

        <!-- Loop through JSON-decoded filenames -->
        @foreach(json_decode($file->filename) as $photo)
            <img src="{{ asset('uploads/' . $photo) }}" alt="{{ $file->description }}" style="max-width: 100px;">
        @endforeach


            <!-- Display all comments for the file -->
            <h3>Comments:</h3>
            @if($file->comments->isEmpty())
                <p>No comments yet.</p>
            @else
                @foreach($file->comments as $comment)
                    <p><strong>{{ $comment->user->username }}:</strong> {{ $comment->comment }}</p>
                @endforeach
            @endif

            <!-- Check if the authenticated user is allowed to comment -->
            @if(Auth::check() && Auth::id() == $file->user_id)
                <form action="{{ route('post-comment', $file->id) }}" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="Write your comment..."></textarea>
                    <button type="submit">Submit Comment</button>
                </form>
            @else
                <p><strong>Only {{ $file->user->username }} can comment on this photo.</strong></p>
            @endif
        </div>
    @endforeach --}}

    <script src="{{ asset('js/viewp.js') }}"></script>
</body>
</html>