<!-- resources/views/view_photos.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Uploaded Photos</title>
    <!-- Add Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Your Uploaded Photos</h2>

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
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100" alt="Uploaded Photo">
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

                <!-- Display the description -->
                <p>{{ $photo->description }}</p>

                <!-- Display the user who uploaded the file -->
                <p>Uploaded by: {{ $photo->user->name }}</p>
            @endforeach
        @endif
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
