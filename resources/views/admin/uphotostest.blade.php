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
    <link rel="stylesheet" href="style.css">
    <style>
        /* optional google fonts */
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap');
body{
    background-color: #7494EC;
    padding: 30px;
    margin: 0px;
}
*{
    font-family: 'Ubuntu', sans-serif;
}
.container{
    text-align: center;
    width: 100%;
    max-width: 500px;
    min-height: 435px;
    margin: auto;
    background-color: white;
    border-radius: 16px;
    box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}

.header-section{
    padding: 25px 0px;
}
.header-section h1{
    font-weight: 500;
    font-size: 1.7rem;
    text-transform: uppercase;
    color: #707EA0;
    margin: 0px;
    margin-bottom: 8px;
}
.header-section p{
    margin: 5px;
    font-size: 0.95rem;
    color: #707EA0;
}

.drop-section{
    min-height: 250px;
    border: 1px dashed #A8B3E3;
    background-image: linear-gradient(180deg, white, #F1F6FF);
    margin: 5px 35px 35px 35px;
    border-radius: 12px;
    position: relative;
}
.drop-section div.col:first-child{
    opacity: 1;
    visibility: visible;
    transition-duration: 0.2s;
    transform: scale(1);
    width: 200px;
    margin: auto;
}
.drop-section div.col:last-child{
    font-size: 40px;
    font-weight: 700;
    color: #c0cae1;
    position: absolute;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    margin: auto;
    width: 200px;
    height: 55px;
    pointer-events: none;
    opacity: 0;
    visibility: hidden;
    transform: scale(0.6);
    transition-duration: 0.2s;
}
/* we will use "drag-over-effect" class in js */
.drag-over-effect div.col:first-child{
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: scale(1.1);
}
.drag-over-effect div.col:last-child{
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}
.drop-section .cloud-icon{
    margin-top: 25px;
    margin-bottom: 20px;
}
.drop-section span,
.drop-section button{
    display: block;
    margin: auto;
    color: #707EA0;
    margin-bottom: 10px;
}
.drop-section button{
    color: white;
    background-color: #5874C6;
    border: none;
    outline: none;
    padding: 7px 20px;
    border-radius: 8px;
    margin-top: 20px;
    cursor: pointer;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}
.drop-section input{
    display: none;
}

.list-section{
    display: none;
    text-align: left;
    margin: 0px 35px;
    padding-bottom: 20px;
}
.list-section .list-title{
    font-size: 0.95rem;
    color: #707EA0;
}
.list-section li{
    display: flex;
    margin: 15px 0px;
    padding-top: 4px;
    padding-bottom: 2px;
    border-radius: 8px;
    transition-duration: 0.2s;
}
.list-section li:hover{
    box-shadow: #E3EAF9 0px 0px 4px 0px, #E3EAF9 0px 12px 16px 0px;
}
.list-section li .col{
    flex: .1;
}
.list-section li .col:nth-child(1){
    flex: .15;
    text-align: center;
}
.list-section li .col:nth-child(2){
    flex: .75;
    text-align: left;
    font-size: 0.9rem;
    color: #3e4046;
    padding: 8px 10px;
}
.list-section li .col:nth-child(2) div.name{
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 250px;
    display: inline-block;
}
.list-section li .col .file-name span{
    color: #707EA0;
    float: right;
}
.list-section li .file-progress{
    width: 100%;
    height: 5px;
    margin-top: 8px;
    border-radius: 8px;
    background-color: #dee6fd;
}
.list-section li .file-progress span{
    display: block;
    width: 0%;
    height: 100%;
    border-radius: 8px;
    background-image: linear-gradient(120deg, #6b99fd, #9385ff);
    transition-duration: 0.4s;
}
.list-section li .col .file-size{
    font-size: 0.75rem;
    margin-top: 3px;
    color: #707EA0;
}
.list-section li .col svg.cross,
.list-section li .col svg.tick{
    fill: #8694d2;
    background-color: #dee6fd;
    position: relative;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
}
.list-section li .col svg.tick{
    fill: #50a156;
    background-color: transparent;
}
.list-section li.complete span,
.list-section li.complete .file-progress,
.list-section li.complete svg.cross{
    display: none;
}
.list-section li.in-prog .file-size,
.list-section li.in-prog svg.tick{
    display: none;
}
    </style>
</head>

<body>
    <div class="container">
        <form method="post"  action="{{ url('save-uphotos') }}"> enctype="multipart/form-data"> <!-- Added enctype -->
            @csrf
            <div class="header-section">
                <h1>Upload Files</h1>
                <p>Upload files you want to share with your team members.</p>
                <p>PDF, Images & Videos are allowed.</p>
            </div>
            <div class="drop-section">
                <div class="col">
                    <div class="cloud-icon">
                        <img src="icons/cloud.png" alt="cloud">
                    </div>
                    <span>Drag & Drop your files here</span>
                    <span>OR</span>
                    <button type="button" class="file-selector">Browse Files</button>
                    <input type="file" name="filename" class="file-selector-input" multiple style="display: none;"> <!-- Hide the file input -->
                </div>
                <div class="col">
                    <div class="drop-here">Drop Here</div>
                </div>
            </div>
            <div class="list-section">
                <div class="list-title">Uploaded Files</div>
                <ul class="list"></ul>
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
            

    <div>
        <h1>Description</h1>
        <input type="text" name="description">
        <h1>Comment</h1>
        <input type="text" placeholder="Enter user name" name="username" required>
    </div>


            <div class="button-container">
                <button type="submit" class="button-6" role="button">Submit</button>
            </div>
        </form>
    </div>

    <script>
        const dropSection = document.querySelector('.drop-section');
        const fileInput = document.querySelector('.file-selector-input');
        const uploadBtn = document.querySelector('.file-selector');
        const fileList = document.querySelector('.list');

        // Handle file selection through the button
        uploadBtn.addEventListener('click', function () {
            fileInput.click();
        });

        // Handle drag and drop events
        dropSection.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropSection.classList.add('drag-over-effect');
        });

        dropSection.addEventListener('dragleave', () => {
            dropSection.classList.remove('drag-over-effect');
        });

        dropSection.addEventListener('drop', (e) => {
            e.preventDefault();
            dropSection.classList.remove('drag-over-effect');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        // Handle file selection
        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            [...files].forEach(file => {
                const li = document.createElement('li');
                li.className = 'in-prog';
                li.innerHTML = `<div class="file-name"><span>${file.name}</span></div>
                                <div class="file-size">${(file.size / 1024).toFixed(2)} KB</div>`;
                fileList.appendChild(li);
            });
        }


          // Get all category items
    const categoryItems = document.querySelectorAll('.category-item');
    const selectedCategoryInput = document.getElementById('selected-category');
    const displaySelectedCategory = document.getElementById('display-selected-category');

    // Add click event listener to each category item
    categoryItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            const selectedCategory = this.getAttribute('data-category');
            selectedCategoryInput.value = selectedCategory; // Set the hidden input value
            displaySelectedCategory.value = selectedCategory; // Display selected category in the text input
        });
    });
    </script>
</body>
</html>