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

        .toggleCheckbox:checked + .toggleContainer::before {
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
        .toggleCheckbox + .toggleContainer div:first-child {
            color: white;
        }

        .toggleCheckbox + .toggleContainer div:last-child {
            color: black;
        }

        /* When "View Photos" is selected */
        .toggleCheckbox:checked + .toggleContainer div:first-child {
            color: black;
        }

        .toggleCheckbox:checked + .toggleContainer div:last-child {
            color: white;
        }

        .container {
            display: flex;
            justify-content: space-between; /* Left and right horizontally aligned */
            align-items: flex-start;
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }

        .left {
            background-color: #A36361;
            padding: 20px;
            color: white;
            flex: 0 0 20%; /* Left takes 20% width */
            margin-right: 10px;
            height: 80vh;
        }

        .right {
            background-color: #E8B298;
            padding: 20px;
            color: #343434;
            flex: 0 0 80%; /* Right takes 80% width */
            text-align: center;
            height: 80vh;
        }

        .category-container {
            margin-top: 20px;
        }

        .category-list {
            display: flex;
            flex-direction: column; /* Stack the categories vertically */
            gap: 15px;
        }

        .category-list a {
            background-color: #EECC8C;
            color: black;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .category-list a:hover {
            background-color: #A36361;
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
            <h1 class=" font-bold">Categories</h1>
            <div class="category-container">
                <div class="category-list">
                    <a href="#">Wedding</a>
                    <a href="#">Birthday</a>
                    <a href="#">Debut</a>
                    <a href="#">Graduation</a>
                    <a href="#">Prom</a>
                    <a href="#">Others</a>
                </div>
            </div>
        </div>

        <div class="right">
            Right Section (80%)
        </div>
    </div>





    

    
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

@endsection
