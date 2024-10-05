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
    @foreach($files as $file)
    <div class="file">
        <img src="{{ asset('uploads/' . $file->filename) }}" alt="{{ $file->description }}">
        <p>Description: {{ $file->description }}</p>
        <p>Uploaded by: {{ $file->user->username }}</p>
        <a href="{{ route('delete-file', $file->id) }}" onclick="return confirm('Are you sure you want to delete this file?')">Delete</a>
    </div>
@endforeach


    <script src="{{ asset('js/viewp.js') }}"></script>
</body>
</html>
