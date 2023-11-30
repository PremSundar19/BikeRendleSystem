<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bike Rental Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row content-justify-center">
            <div class="col-md-6">
                <div id="message-container"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2 class="text-center">Bike Rental Bill</h2>
            <hr>
            <div class="col-md-4">
                <address>
                    <strong>JK Bike Rental Company</strong><br>
                    123 Gandhi Street<br>
                    Chennai-600123<br>
                    jk123@bikerental.com<br>
                    99865 31507
                </address>
            </div>
            <div class="col-md-4">
                <strong>Bike Booked Details</strong>
                <ul class="list-unstyled">
                    <li><strong>Book Date &nbsp; &nbsp;:</strong> {{$booking['booked_date']}}</li>
                    <li><strong>Book Time &nbsp; &nbsp;:</strong> {{$booking['booked_time']}}</li>
                    <li><strong>Return Date &nbsp;:</strong> {{$booking['return_date']}}</li>
                    <li><strong>Return Time &nbsp;:</strong> {{$booking['return_time']}}</li>
                </ul>
            </div>
            <div class="col-md-4 text-end">
                <strong>Bill To</strong>
                <address>
                    <strong> {{$booking['customer_name']}}</strong><br>
                    {{$booking['address']}} <br>
                    {{$booking['customer_email']}} <br>
                    {{$booking['mobile']}}
                </address>
            </div>
        </div>
        <hr>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Brand</th>
                    <th scope="col">Bike</th>
                    <th scope="col">Rate per Hour</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Rent_Amount</th>
                    <th scope="col">Fine_Amount</th>
                    <th scope="col">total_Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$booking['brand_name']}}</td>
                    <td>{{$booking['bike_name']}}</td>
                    <td>{{$booking['perhr']}} Rs</td>
                    <td> {{$booking['wanted_period']}} {{$booking['duration']}}</td>
                    <td>{{$booking['paid_amount']}} Rs</td>
                    <td>{{$booking['fine_amount']}} Rs</td>
                    <td>{{$booking['totalAmount']}} Rs</td>
                </tr>
            </tbody>
        </table>
        <div class="text-end mt-4">
           
            <a href="{{url('admindashboard')}}" class="btn btn-secondary btn-xs py-0">Back</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>