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
                    <li><strong>Book Date &nbsp; &nbsp;:</strong> {{$booking[0]->booked_date}}</li>
                    <li><strong>Book Time &nbsp; &nbsp;:</strong> {{$booking[0]->booked_time}}</li>
                    <li><strong>Return Date &nbsp;:</strong> {{$booking[0]->return_date}}</li>
                    <li><strong>Return Time &nbsp;:</strong> {{$booking[0]->return_time}}</li>
                </ul>
            </div>
            <div class="col-md-4 text-end">
                <strong>Bill To</strong>
                <address>
                    <strong> {{$booking[0]->customer_name}}</strong><br>
                    {{$booking[0]->address}} <br>
                    {{$booking[0]->customer_email}} <br>
                    {{$booking[0]->mobile}}
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
                    <th scope="col">Paid Amount</th>
                    <th scope="col">Fine Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$booking[0]->brand_name}}</td>
                    <td>{{$booking[0]->bike_name}}</td>
                    <td>{{$booking[0]->per_hour_rent}} Rs</td>
                    <td> {{$booking[0]->wanted_period}} {{$booking[0]->duration}}</td>
                    <td>{{$booking[0]->total_amount}} Rs</td>
                    <td>{{$booking[0]->fine_amount}} Rs</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end"><strong>Total</strong></td>
                    <td>{{$booking[0]->fine_amount}} Rs</td>
                </tr>
            </tfoot>
        </table>
        <div class="text-end mt-4">
            @if($booking[0]->fine_amount === 0)
            <button type="button" class="btn btn-primary pay btn-xs py-0">Return</button>
            @endif
            @if($booking[0]->fine_amount > 0)
            <button type="button" class="btn btn-primary pay btn-xs py-0">Pay Fine</button>
            @endif
            <a href="{{url('dashboard')}}" class="btn btn-secondary btn-xs py-0">Cancel</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(() => {

            $('.pay').click(() => {
                $.ajax({
                    url: '{{url('updateVehicle')}}',
                    type: 'POST',
                    data: {
                        booking: {!! json_encode($booking) !!},
            }, headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success: function (respone) {
                    $('#message-container').html('<div class="alert alert-success text-center">' + respone.message + '</div>');
                    setTimeout(() => {
                        $('#message-container').empty();
                        window.location.href = '/dashboard';
                    }, 2500);
                }
          })
        })
        })
    </script>
</body>
</html>