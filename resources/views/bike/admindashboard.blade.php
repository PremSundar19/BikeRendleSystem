
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JkBikes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-size: cover;
            background-position: absolute;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
        }

        .navbar-brand img {
            height: 30px;
            width: auto;
            margin-right: 10px;
        }

        .form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(55, 75, 85, 0.5);
        }

        .form-control {
            text-align: center;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="ktm/rcnobc.png" alt="Bike Logo">
            JK Bike
        </a>

        <div class="container  justify-content-center">
            <div class="alert alert-success text-center customerName" role="alert">
                Admin DashBoard
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" data-target="#addbikeModal" data-toggle="modal">AddBike</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('logout_Admin')}}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Book Bike Modal -->
    <div class="modal fade " id="addbikeModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="addbikeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addbikeModalLabel">Book Bike For Rend</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('storeBike')}}" method="post" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="brand_name" name="brand_name"
                                    placeholder="- Brand Name -" value="{{old('brand_name') ? : ''}}">
                                @error('brand_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="bike_name" class="form-control" name="bike_name"
                                    placeholder="- Bike Name -" value="{{old('bike_name') ? : ''}}">
                                @error('bike_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="bike_cc" class="form-control" name="bike_cc"
                                    placeholder="- Bike CC -" value="{{old('bike_cc') ? : ''}}">
                                @error('bike_cc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="AddBook" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div id="message-container"></div>
        <div class="card">
            <div class="card-body">
                <div class="bg-secondary  p-2  m-2">
                    <h5 class="text-center">All Booked Bike Details</h5>
                </div>
                <table class="table  table-bordered table-stripted table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Per/hr price</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Fine Amount</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody id="BookedBikeData">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>

        $(document).ready(() => {

            $.ajax({
                url: '/fetchBookings',
                type: 'GET',
                success: function (respone) {
                    $('#BookedBikeData').empty();
                    var tr = '';
                    $.each(respone, function (index, booking) {
                        var id = booking.booking_id;
                        tr += '<tr>';
                        tr += '<td>' + booking.customer_name + '</td>';
                        tr += '<td>' + booking.customer_email + '</td>';
                        tr += '<td>' + booking.brand_name + '</td>';
                        tr += '<td>' + booking.bike_name + '</td>';
                        tr += '<td>' + booking.wanted_period + ' ' + booking.duration + '</td>';
                        tr += '<td>' + booking.per_hour_rent + ' Rs' + '</td>';
                        tr += '<td>' + booking.total_amount + ' Rs' + '</td>';
                        tr += '<td>' + booking.fine_amount + '</td>';
                        tr += '<td>' + booking.status + '</td>';
                        // tr += '<td>'+ '<input type="number" >' +'</td>'
                        tr += '</tr>';
                    })
                    $('#BookedBikeData').append(tr);
                }
            })

            $('#logout').on('click', () => {
                window.relocation.href = '/index';
            })
        })
    </script>
</body>

</html>