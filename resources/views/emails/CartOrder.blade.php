<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
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
        <div class="order-time-date">
            <p><strong>Order Date:</strong> {{ $mailData['order_date'] }}</p>
            <p><strong>Order Time:</strong> {{ $mailData['order_time'] }}</p>
        </div>

        <h2>Hello, {{ $mailData['name'] }}!</h2>
        <p>Thank you for your order. Here are the details:</p>

        <div class="order-detail">
            <h4>Order ID: {{ $mailData['orderid'] }}</h4>
            <p><i class="fa-solid fa-cart-shopping"></i>Product Name: {{ $mailData['product_name'] }} </p>
            <p><i class="fa-duotone fa-cubes"></i> Product Quantity: {{ $mailData['quantity'] }}</p>
            <p><i class="fa-solid fa-square-dollar"></i> Product Unit Price: {{ $mailData['product_unit_price'] }} LKR</p>
            <p><i class="fa-solid fa-square-dollar"></i> Product Total Price: {{ $mailData['product_total_price'] }} LKR</p>
            <p><i class="fa-solid fa-square-dollar"></i> Order Delivery Address: {{ $mailData['delivery_Address'] }}</p>
            <p><i class="fa-solid fa-square-dollar"></i> Order Receiver Mobile: {{ $mailData['receiver_mobile'] }}</p>
        </div>
    </div>

</body>

</html>
