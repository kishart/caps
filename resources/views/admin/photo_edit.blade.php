@extends('layouts.nav')

@section('content')

<head>
    <title>Edit Photo</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Photo Description</h2>

        <form action="{{ route('photo.update', $photo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $photo->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>

@endsection
