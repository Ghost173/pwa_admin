<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Cancellation Request</title>
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
            color: red; /* Updated color to red */
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .order-time-date {
            margin-bottom: 20px;
        }

        .order-detail {
            margin-top: 30px;
        }

        .order-detail h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .order-detail p {
            margin-bottom: 5px;
        }

        .icon {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 style="color: red;">Order Cancellation Request</h2>
        <p>You have submitted a request to cancel your order.</p>
        <hr>
        <div class="order-detail">
            <h4>Order Details:</h4>
            <p><strong>Order ID:</strong> {{ $mailData['orderid'] }}</p>
            <p><strong>Customer Name:</strong> {{ $mailData['name'] }}</p>
            <p><strong>Product Name:</strong> {{ $mailData['product_name'] }}</p>
            <p><strong>Product Quantity:</strong> {{ $mailData['quantity'] }}</p>
            <p><strong>Product Unit Price:</strong> {{ $mailData['product_unit_price'] }}</p>
            <p><strong>Product Total Price:</strong> {{ $mailData['product_total_price'] }}</p>
        </div>
    </div>
</body>

</html>