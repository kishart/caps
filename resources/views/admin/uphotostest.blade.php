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
        <form method="post" enctype="multipart/form-data" action="{{ route('save-uphotos') }}">
            @csrf
            <div class="header-section">
                <h1>Upload Files</h1>
                <p>Upload files you want to share with your team members.</p>
                <p>PDF, Images & Videos are allowed.</p>
            </div>
            <div class="drop-section">
                <div class="col">
                    <div class="cloud-icon">
                        <img src="{{ asset('images/icons/cloud.png') }}" alt="logo">
                    </div>
                    <span>Drag & Drop your files here</span>
                    <span>OR</span>
                    <button class="file-selector">Browse Files</button>
                    <input type="file" name="filename" class="file-selector-input" multiple>
                </div>
                <div class="col">
                    <div class="drop-here">Drop Here</div>
                </div>
            </div>
            <div class="list-section">
                <div class="list-title">Uploaded Files</div>
                <div class="list"></div>
            </div>
            

            <h1 class="font-bold">Categories</h1>
            <div class="category-container">
                <div class="category-list">
                    <a href="#" class="category-item" data-category="Wedding">Wedding</a>
                    <a href="#" class="category-item" data-category="Birthday">Birthday</a>
                    <!-- Other categories -->
                </div>
            </div>
            
            <!-- Hidden input field to hold the selected category -->
            <input type="hidden" id="selected-category" name="category">
            <input type="text" id="display-selected-category" placeholder="Selected Category" readonly>
            

    {{-- <div>
        <h1>Description</h1>
        <input type="text" name="description">
       
        <h1>Choose username that only can comment to the photos:</h1>
        <input type="text" placeholder="Enter user name" name="username" required>
    </div> --}}
    <div>
        <h1>Description</h1>
        <input type="text" name="description">
    </div>
        <div>
            <div>
                <h1>Choose a username:</h1>
                <select name="user_id" required>
                    <option value="" disabled selected>Select a username</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
                
            </div>
            
        
            
        </div>


        

        
    

            <div class="button-container">
                <button type="submit" class="button-6" role="button">Submit</button>
            </div>
        </form>
    </div>

  <script src="{{ asset('js/uphotostest.js') }}"></script>
</body>
</html>