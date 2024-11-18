@extends('layouts.adminsidebar')

@section('content')

<head>
    <title>Photo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* .main {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    } */
    /* .images {
        height: 200px; 
        max-width: 100%;
        object-fit: cover;
        border-radius: 10px;
    } */
    .actions {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
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
            <!-- Iterate through each photo for listing -->
            @foreach ($photoUploads as $photo)
                @php
                    $photoPaths = json_decode($photo->photo_paths, true);
                @endphp

                <div class="row mb-4">
                    <div class="col-md-8">
                        <!-- Display the first photo in the carousel as a thumbnail -->
                        @if (is_array($photoPaths) && count($photoPaths) > 0)
                            <img src="{{ asset('storage/' . $photoPaths[0]) }}" class="images" alt="Uploaded Photo">
                        @else
                            <p>No photo available.</p>
                        @endif

                        <p class="mt-2">{{ $photo->description }}</p>
                    </div>

                    <!-- Right Column: Edit/Delete Actions -->
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="actions">
                            <!-- Edit Button -->
                            <a href="{{ route('photo.edit', $photo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('photo.delete', $photo->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
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
