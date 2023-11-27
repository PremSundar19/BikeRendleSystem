


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p>Thank you for your booking!</p>
<p>Details:</p>
<ul>
    <li>Name: {{ $booking->customer_name }}</li>
    <li>Email: {{ $booking->customer_email }}</li>
    <li>Per\hr : {{ $booking->per_hour_rent}}</li>
    <li>total_amount : {{ $booking->total_amount}}</li>
</ul>

</body>
</html>