<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(55, 75, 85, 0.5);
        }

        .center-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row content-justify-center center-container">
            <div class="col-md-5">
                @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}} justify-content-center text-center" id="msg" role="alert">
                    {{ Session::get('message') }}
                </div>
                <script>
                    setTimeout(function () {
                        var alert = document.querySelector('.alert');
                        alert.style.display = 'none';
                        window.location.href = '/dashboard';
                    }, 3000);
                </script>
                @endif
                <form action="{{url('updateVehicle')}}" method="post" class="form">
                    <h4 class="text-success text-center">Bike Return</h4>
                    <hr>
                    @csrf
                    @if($booking)
                    <input type="hidden" class="form-control" name="booking_id" id="booking_id"
                        value="{{ $booking[0]->booking_id }}">
                    <div class="form-group">
                        <label for="name">Customer Name</label>
                        <input type="text" class="form-control" name="name" id="name" readonly
                            value="{{ $booking[0]->customer_name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Customer Email</label>
                        <input type="email" class="form-control" name="email" id="email" readonly
                            value="{{ $booking[0]->customer_email }}">
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand Name</label>
                        <input type="text" class="form-control" name="brand" id="brand" readonly
                            value="{{ $booking[0]->brand_name }}">
                    </div>
                    <div class="form-group">
                        <label for="bikename">Bike Name</label>
                        <input type="text" class="form-control" name="bikename" id="bikename" readonly
                            value="{{ $booking[0]->bike_name }}">
                    </div>
                    <div class="form-group">
                        <label for="paidamount">Paid Amount</label>
                        <input type="text" class="form-control" name="paidamount" id="paidamount" readonly
                            value="{{ $booking[0]->total_amount }}">
                    </div>
                    <div class="form-group">
                        <label for="fineamount">Fine Amount</label>
                        <input type="text" class="form-control" name="fineamount" id="fineamount" readonly
                            value="{{ $booking[0]->fine_amount }}">
                    </div>
                    <br>
                    <div class="form-group">
                        @if($booking[0]->fine_amount === 0)
                        <input type="submit" value="Return" class="btn btn-primary btn-xs py-0">
                        @endif
                        @if($booking[0]->fine_amount > 0)
                        <input type="submit" value="Pay" class="btn btn-primary btn-xs py-0">
                        @endif
                        <a href="{{url('dashboard')}}" class="btn btn-success btn-xs py-0">Close</a>
                    </div>
                    @endif
                
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</body>

</html>