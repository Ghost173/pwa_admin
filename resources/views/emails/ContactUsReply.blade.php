<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .thank-you-message {
            margin-top: 30px;
        }

        .thank-you-message p {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .thank-you-message p:last-child {
            margin-bottom: 0;
        }

        .icon {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello, {{$name}}!</h2>
        <div class="thank-you-message">
            <p>Thank you for contacting us.</p>
            <p>We appreciate your interest and will get back to you as soon as possible.</p>
            <p>In the meantime, feel free to explore our website for more information.</p>
        </div>
    </div>
</body>
</html>