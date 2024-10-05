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
                <table class="table">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Uploaded By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->filename }}</td>
                                <td>{{ $file->category }}</td>
                                <td>{{ $file->description }}</td>
                                <td>{{ $file->user->username }}</td>
                                <td>
                                    <a href="{{ asset('uploads/' . $file->filename) }}" target="_blank">View</a>
                                    <a href="{{ route('delete-file', $file->id) }}" onclick="return confirm('Are you sure you want to delete this file?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Display file details and comments -->
    @foreach($files as $file)
        <div class="file">
            <img src="{{ asset('uploads/' . $file->filename) }}" alt="{{ $file->description }}">
            <p>Description: {{ $file->description }}</p>
            <p>Uploaded by: {{ $file->user->username }}</p>

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
    @endforeach

    <script src="{{ asset('js/viewp.js') }}"></script>
</body>
</html>
