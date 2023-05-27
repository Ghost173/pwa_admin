<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password?</title>
</head>
<body>
    Change your password <a href="http://127.0.0.1:8000/passwirdreset/{{$token}}">Click Here</a>
    <br>
    Pincode: {{$token}}
</body>
</html>