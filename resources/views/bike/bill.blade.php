<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JK Bike Rental Bill</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 20px;
        }
    </style>
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
            <div class="col-md-6">
                <h2>Bike Rental Bill</h2>
                <address>
                    <strong>JK Bike Rental Company</strong><br>
                    123 gandhi Street<br>
                    chennai-600123<br>
                    jk123@bikerental.com<br>
                    99865 31507
                </address>
            </div>
            <div class="col-md-6 text-end">
                <h2>Invoice To</h2>
                <address>
                    <strong>{{ $booking['customer_name'] }}</strong><br>
                    {{$booking['address']}}<br>
                    {{ $booking['customer_email'] }}<br>
                    {{$booking['mobile']}}
                </address>
            </div>
        </div>
        <hr>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Bike</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Rate per Hour</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $booking['bike_name'] }}</td>
                    <td>{{ $booking['wanted_period'] }} {{ $booking['duration'] }}</td>
                    <td>${{ $booking['per_hour_rent'] }}</td>
                    <td>${{ $booking['total_amount'] }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td><strong>${{ $booking['total_amount'] }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="text-end mt-4">
            <button type="button" class="btn btn-primary pay">Pay Now</button>
            <a href="{{url('showBikeBookForm')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            $('.pay').click(() => {
                $.ajax({
                    url: '{{url('store')}}',
                    type: 'POST',
                    data: {
                        booking : {!! json_encode($booking) !!},
            }, headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (respone) {
                $('#message-container').html('<div class="alert alert-success text-center">' + respone.message +'</div>');
                setTimeout(() => {
                    $('#message-container').empty();
                    window.relocation.href = '/dashboard';
                }, 2500);
            }
          })
        })
      })

    </script>
</body>

</html>