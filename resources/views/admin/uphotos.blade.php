@extends('layouts.adminsidebar')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Upload Photos</title>
    <style>
        .toggleContainer {
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            width: fit-content;
            border-radius: 20px;
            background: #E8B298;
            font-weight: bold;
            color: #343434;
            cursor: pointer;
            margin-top: 30px;
            padding: 5px 10px;
        }

        .toggleContainer::before {
            content: '';
            position: absolute;
            width: 50%;
            height: 100%;
            left: 0%;
            border-radius: 20px;
            background: #A36361;
            transition: all 0.3s;
        }

        .toggleCheckbox:checked+.toggleContainer::before {
            left: 50%;
        }

        .toggleContainer div {
            padding: 6px;
            text-align: center;
            z-index: 1;
            font-size: 16px;
            background-color: transparent;
        }

        .toggleCheckbox {
            display: none;
        }

        /* Default state: Edit Photos selected */
        .toggleCheckbox+.toggleContainer div:first-child {
            color: white;
        }

        .toggleCheckbox+.toggleContainer div:last-child {
            color: black;
        }

        /* When "View Photos" is selected */
        .toggleCheckbox:checked+.toggleContainer div:first-child {
            color: black;
        }

        .toggleCheckbox:checked+.toggleContainer div:last-child {
            color: white;
        }

        .container {
            display: flex;
            justify-content: space-between;
            /* Left and right horizontally aligned */
            align-items: flex-start;
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }

        .left {
            background-color: white;
            padding: 20px;
            color: white;
            flex: 0 0 20%;
            /* Left takes 20% width */
            margin-right: 10px;
            height: 80vh;
        }

        .right {
            background-color: #E8B298;
            padding: 20px;
            color: #343434;
            flex: 0 0 80%;
            /* Right takes 80% width */
            text-align: center;
            height: 80vh;
        }

        .category-container {
            margin-top: 20px;
        }

        .category-list {
            display: flex;
            flex-direction: column;
            /* Stack the categories vertically */
            gap: 15px;
        }

        .category-list a {
            background-color: #EECC8C;
            color: black;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;

            text-decoration: none;
            color: #000;
            /* Default color */
        }


        .category-list a.active {
            font-weight: bold;
            /* Example style for active link */
            color: white;
            /* Change color for active link */

            background-color: #A36361;
        }

        .category-list a:hover {
            background-color: #E8B298;
            color: white;
        }



        .drop-section {
            min-height: 250px;
            border: 1px dashed #A8B3E3;
            background-image: linear-gradient(180deg, white, #F1F6FF);
            margin: 5px 35px 35px 35px;
            border-radius: 12px;
            position: relative;
        }

        .drop-section div.col:first-child {
            opacity: 1;
            visibility: visible;
            transition-duration: 0.2s;
            transform: scale(1);
            width: 200px;
            margin: auto;
        }

        .drop-section div.col:last-child {
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
        .drag-over-effect div.col:first-child {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: scale(1.1);
        }

        .drag-over-effect div.col:last-child {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        .drop-section .cloud-icon {
            margin-top: 25px;
            margin-bottom: 20px;
        }

        .drop-section span,
        .drop-section button {
            display: block;
            margin: auto;
            color: #707EA0;
            margin-bottom: 10px;
        }

        .drop-section button {
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

        .drop-section input {
            display: none;
        }

        .list-section {
            display: none;
            text-align: left;
            margin: 0px 35px;
            padding-bottom: 20px;
        }

        .list-section .list-title {
            font-size: 0.95rem;
            color: #707EA0;
        }

        .list-section li {
            display: flex;
            margin: 15px 0px;
            padding-top: 4px;
            padding-bottom: 2px;
            border-radius: 8px;
            transition-duration: 0.2s;
        }

        .list-section li:hover {
            box-shadow: #E3EAF9 0px 0px 4px 0px, #E3EAF9 0px 12px 16px 0px;
        }

        .list-section li .col {
            flex: .1;
        }

        .list-section li .col:nth-child(1) {
            flex: .15;
            text-align: center;
        }

        .list-section li .col:nth-child(2) {
            flex: .75;
            text-align: left;
            font-size: 0.9rem;
            color: #3e4046;
            padding: 8px 10px;
        }

        .list-section li .col:nth-child(2) div.name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 250px;
            display: inline-block;
        }

        .list-section li .col .file-name span {
            color: #707EA0;
            float: right;
        }

        .list-section li .file-progress {
            width: 100%;
            height: 5px;
            margin-top: 8px;
            border-radius: 8px;
            background-color: #dee6fd;
        }

        .list-section li .file-progress span {
            display: block;
            width: 0%;
            height: 100%;
            border-radius: 8px;
            background-image: linear-gradient(120deg, #6b99fd, #9385ff);
            transition-duration: 0.4s;
        }

        .list-section li .col .file-size {
            font-size: 0.75rem;
            margin-top: 3px;
            color: #707EA0;
        }

        .list-section li .col svg.cross,
        .list-section li .col svg.tick {
            fill: #8694d2;
            background-color: #dee6fd;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }

        .list-section li .col svg.tick {
            fill: #50a156;
            background-color: transparent;
        }

        .list-section li.complete span,
        .list-section li.complete .file-progress,
        .list-section li.complete svg.cross {
            display: none;
        }

        .list-section li.in-prog .file-size,
        .list-section li.in-prog svg.tick {
            display: none;
        }

        /* For the dropdown category */
        .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Arrow styling */
.arrow {
    margin-left: 10px;
    font-size: 14px;
}

/* Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Add active class styling */
.dropdown-content a.active {
    font-weight: bold;
    background-color: #4CAF50;
    color: white;
}
    </style>
    </head>

    <body>
        <input type="checkbox" id="toggle" class="toggleCheckbox" />
        <label for="toggle" class='toggleContainer'>
            <div>Edit Photos</div>
            <div>View Photos</div>
        </label>

        <div class="container">
            <div class="left text-center">
                <div class="description text-black">
                    
                    <h1>User who can only comment</h1>
                    <input type="text">

                   
                    
<label for="message" class="block mb-2 text-sm text-left font-medium text-gray-900 dark:text-white">Description</label>
<textarea id="message" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Write your thoughts here..."></textarea>

                </div>
                <div class="dropdown">
                    <h1>Category</h1>
                    <button class="dropbtn" style="border-radius: 30px; padding: 10px 20px; width: auto;">
                        Select Category 
                        <ion-icon name="caret-down-circle-outline"></ion-icon>
                    </button>
                    <div class="dropdown-content" style="border-radius: 30px; padding: 10px 20px;">
                        <a href="#" class="dropdown-item">Wedding</a>
                        <a href="#" class="dropdown-item">Birthday</a>
                        <a href="#" class="dropdown-item">Debut</a>
                        <a href="#" class="dropdown-item">Graduation</a>
                        <a href="#" class="dropdown-item">Prom</a>
                        <a href="#" class="dropdown-item">Others</a>
                    </div>
                </div>
                

             
            </div>

            <div class="right">
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


             
            </div>
        </div>








        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categoryLinks = document.querySelectorAll('.category-list a');

                categoryLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        // Remove 'active' class from all links
                        categoryLinks.forEach(link => link.classList.remove('active'));

                        // Add 'active' class to the clicked link
                        this.classList.add('active');
                    });
                });
            });
//for the dropdown category

document.addEventListener('DOMContentLoaded', function () {
    const categoryLinks = document.querySelectorAll('.dropdown-content a');
    const dropdownButton = document.querySelector('.dropbtn');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Remove 'active' class from all links
            categoryLinks.forEach(link => link.classList.remove('active'));
            
            // Add 'active' class to the clicked link
            this.classList.add('active');
            
            // Update dropdown button text with selected category
            dropdownButton.firstChild.textContent = this.textContent;
        });
    });
});

            
        </script>
        <script src="{{ asset('js/uphotostest.js') }}"></script>

    </body>
@endsection
