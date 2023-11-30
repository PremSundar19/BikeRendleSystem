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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
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
            @if(Session::has('message'))
            <div class="alert alert-danger text-center col-md-6" id="msg" role="alert" style="width: 300px;">
                {{ Session::get('message') }}
            </div>
            <script>
                setTimeout(function () {
                    var alert = document.querySelector('#msg');
                    alert.style.display = 'none';
                }, 2500);
            </script>
            @endif
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" data-target="#addbikeModal" data-toggle="modal">AddBike</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link listOfCustomers" data-target="#customers" data-toggle="modal">ViewUsers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" id="logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="modal fade" id="customers">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title black" id="customersmodal">Customers Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripted">
                        <thead>
                            <tr>
                                <th>firstName</th>
                                <th>lastName</th>
                                <th>Email </th>
                                <th>dob</th>
                                <th>age</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody class="customer_data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bike Modal -->
    <div class="modal fade " id="addbikeModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addbikeModalLabel">Book Bike For Rend</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table-hover">
                        <tbody>
                            <tr>
                                <form action="{{url('storeBike')}}" method="post">
                                    @csrf
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                                placeholder="- Brand Name -" value="{{old('brand_name') ? : ''}}"
                                                required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="bike_name" class="form-control" name="bike_name"
                                                placeholder="- Bike Name -" value="{{old('bike_name') ? : ''}}"
                                                required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" id="bike_cc" class="form-control" name="bike_cc"
                                                placeholder="- Bike CC -" value="{{old('bike_cc') ? : ''}}" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" id="per_hour" class="form-control" name="per_hour"
                                                placeholder="- per hour Cost -" value="{{old('per_hour') ? : ''}}"
                                                required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="submit" value="AddBike" class="btn btn-primary">
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
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
                            <th scope="col">Rent_Paid</th>
                            <th scope="col">Fine_Amount</th>
                            <th scope="col">status</th>
                            <th>Bill</th>
                        </tr>
                    </thead>
                    <tbody id="BookedBikeData">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(() => {
            $.ajax({
                url: '{{url('fetchBookings')}}',
                type: 'GET',
                success: function (respone) {
                    $('#BookedBikeData').empty();
                    var tr = '';
                    $.each(respone, function (index, booking) {
                        var id = booking.customer_id;
                        tr += '<tr>';
                        tr += '<td>' + booking.customer_name + '</td>';
                        tr += '<td>' + booking.customer_email + '</td>';
                        tr += '<td>' + booking.brand_name + '</td>';
                        tr += '<td>' + booking.bike_name + '</td>';
                        tr += '<td>' + booking.wanted_period + ' ' + booking.duration + '</td>';
                        tr += '<td>' + booking.per_hour_rent + ' Rs' + '</td>';
                        tr += '<td>' + booking.total_amount + ' Rs' + '</td>';
                        tr += '<td>' + booking.fine_amount + ' Rs' + '</td>';
                        tr += '<td>' + booking.status + '</td>';
                        if (booking.status === "bike returned") {
                            tr += '<td><div class="d-flex">';
                            tr += '<a class="btn btn-secondary btn-xs py-1" href="/showBill/' + booking.booking_id + '">viewBill</a>';
                            tr += '</div></td>';
                        }
                        tr += '</tr>';
                    })
                    $('#BookedBikeData').append(tr);
                }
            })

            $('.listOfCustomers').on('click', () => {
                $('.customer_data').empty();
                $.ajax({
                    url: '{{url('fetchCustomers')}}',
                    type: 'GET',
                    success: function (respone) {
                        var tr = '';
                        $.each(respone, function (index, customer) {
                            tr += '<tr>';
                            tr += '<td>' + customer.firstname + '</td>';

                            if (customer.lastname === null) {
                                tr += '<td></td>';
                            } else {
                                tr += '<td>' + customer.lastname + '</td>';
                            }

                            tr += '<td>' + customer.email + '</td>';
                            tr += '<td>' + customer.dob + '</td>';
                            tr += '<td>' + customer.age + '</td>';
                            tr += '<td>' + customer.mobile + '</td>';
                            tr += '<tr>';
                        })
                        $('.customer_data').append(tr);
                    }
                })
            })

            $('#logout').on('click', () => {
                window.location.href = '/index';
            })
        })
    </script>
</body>

</html>