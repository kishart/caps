<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['filename'])) {
        $targetDir = 'uploads/';
        $filename = basename($_FILES['filename']['name']);
        $targetFilePath = $targetDir . $filename;

        // Handle file name collision
        if (file_exists($targetFilePath)) {
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . time() . '.' . pathinfo($filename, PATHINFO_EXTENSION);
            $targetFilePath = $targetDir . $filename;
        }

        // Check for errors
        if ($_FILES['filename']['error'] !== UPLOAD_ERR_OK) {
            echo 'File Upload Error: ' . $_FILES['filename']['error'];
            exit;
        }

        if (move_uploaded_file($_FILES['filename']['tmp_name'], $targetFilePath)) {
            echo 'File Uploaded';
        } else {
            echo 'File Upload Failed';
        }
        exit; // Ensure no further code is processed after file upload
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop File Upload</title>
    <link rel="stylesheet" href="{{ asset('css/uphotostest.css') }}">
</head>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<body>
    <div class="container">
        <form method="POST" enctype="multipart/form-data" action="{{ route('save-uphotos') }}">
            @csrf
            <h1>Upload Files</h1>
        
            <!-- File input for multiple files -->
            <input type="file" name="filename[]" multiple>
        
            <!-- Description field -->
            <h1>Description</h1>
            <input type="text" name="description">
        
            <!-- Username selection dropdown -->
            <h1>Choose a username:</h1>
            <select name="user_id" required>
                <option value="" disabled selected>Select a username</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        
            <!-- Category selection -->
            <input type="hidden" id="selected-category" name="category">
            <input type="text" id="display-selected-category" placeholder="Selected Category" readonly>
        
            
            <!-- Submit button -->
            <button type="submit">Submit</button>
        </form>
        




  <script src="{{ asset('js/uphotostest.js') }}"></script>
</body>
</html>