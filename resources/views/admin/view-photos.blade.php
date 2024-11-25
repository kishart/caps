@extends('layouts.adminsidebar')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/uphotos.css') }}">
    <title>Upload Photos</title>


    <div class="toggle-container">
        <input type="checkbox" id="toggle" class="toggleCheckbox" />
        <label for="toggle" class='toggleContainer'>
            <div id="uploadPhotos" class="toggle-label active">Upload Photos</div>
            <div id="viewPhotos" class="toggle-label">View Photos</div>
        </label>


    </div>

    <h1></h1>

    </div>
    </form>

    <script src="{{ asset('js/vphotos.js') }}"></script>
@endsection



