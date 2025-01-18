<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><span style="font-weight:bolder">From:</span>{{ $data['email']}} </p> 
    <p><span style="font-weight:bolder">Name:</span>{{ ucwords($data['name'])}} </p>  
    <p><span style="font-weight:bolder">Message:</span>{{ ucfirst($data['message'])}} </p>   
</body>
</html>