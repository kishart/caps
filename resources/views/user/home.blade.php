<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        body {
            background-image: url("/images/home.jpg");
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .navbar {
            display: flex;
            align-items: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-right: 20px;
            font-family: "Jost", sans-serif;
            color: white;
            padding-left: 30px;
            margin-bottom: 10px;
        }

        .icon-size {
            font-size: 40px;
            color: #fff;
        }

        .logo {
            width: 100px;
            height: 110px;
            margin-left: 30px;
        }

        h1 {
            font-family: "Jost", serif;
            font-size: 9rem;
            letter-spacing: 10px;
            padding-left: 40px;
            margin: 0;
            line-height: 1;
          
        }

        .phot{
            font-family: "Montserrat", sans-serif;
            letter-spacing: 10px;
            padding-left: 40px;
            margin: 0;
            font-size: 62px;
            font-weight: bold;
            line-height: 1;
            margin-left: 6px;
        }

        .text {
            padding: 0;
            color: white;
            margin-top: 35px;
        }
        .quote{
           font-size: 14px; 
           font-style:italic;
           padding-left: 50px;
           font-family: "Montserrat", sans-serif;
           margin-right: 8px;
        }
        .set {
    display: flex;                  
    align-items: center;          
    padding: 10px 12px;            
    background-color: white;      
    color: black;                   
    border: none;                   
    border-radius: 15px;            
    cursor: pointer;   
    font-weight: 700;    
    font-size:15px;       
}

.set ion-icon {
    padding-right: 10px;    
    font-size: 25px;        
}

.blur-button {
    background-color: transparent;  
    color: white;    
    padding: 10px 20px;           
    border-radius: 15px;             
    font-size:15px;                  
    cursor: pointer;               
    backdrop-filter: blur(5px);     
    transition: background-color 0.3s ease, color 0.3s ease; 
    border: none;      
    color: rgba(255, 255, 255, 1); 
}

.blur-button:hover {
    background-color: rgba(255, 255, 255, 0.1); /* Slightly change background on hover */
   
}

    </style>
</head>

<body>
    <div class="main">
        <div class="header">
            <img src="{{ asset('images/hplogo.jpg') }}" alt="logo" class="logo">
            <nav class="navbar">
                <ul>
                    <li>Home</li>
                    <li>Calendar</li>
                    <li>Photos</li>
                    <li>Message</li>
                    <li><ion-icon name="person-circle-outline" class="icon-size"></ion-icon></li>
                </ul>
            </nav>
        </div>

        <div class="text">
            <h1>HUSNIE</h1>
            <p class="phot"> PHOTOGRAPHY</p>
            <p class="quote">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, eveniet dolorem <br>
                 omnis repellat quisquam voluptatum delectus aperiam corporis ipsam! Odit hic <br>
                  tenetur nam delectus fugiat eligendi </p>
        </div>
        <div class="button">
            <button class="set"><ion-icon name="arrow-forward-circle" ></ion-icon>Set Appointment</button> 
            <button class="blur-button">Calendar</button>

        </div>

    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
