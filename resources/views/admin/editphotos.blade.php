@extends('layouts.adminsidebar')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/editphotos.css') }}">
</head>
<div class="containerp">
    <p class="title">Edit Photos</p>

    @if (Session::has('success'))
        <div class="alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('editphotos.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" class="form-control"
                   placeholder="Enter Description" value="{{ $data->description }}" required>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- User -->
        <div class="form-group">
            <label for="user_id">User:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="" disabled>Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Photos -->
        <div class="form-group">
            <label for="photos">Photos:</label>
            <div class="photo-preview">
                @if (!empty($data->photo_paths) && is_array(json_decode($data->photo_paths)))
                    @foreach (json_decode($data->photo_paths) as $path)
                        <img src="{{ asset('storage/' . $path) }}" alt="Photo" class="photo-thumb">
                    @endforeach
                @else
                    <span>No photos available</span>
                @endif
            </div>
            <input  type="file" name="photos[]" id="photos" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
