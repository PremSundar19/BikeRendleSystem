<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="container  justify-content-center" id="msgz">
                <div class="alert alert-success text-center userName" role="alert">
                </div>
            </div>
            @if(Session::has('message'))
            <div class="alert alert-danger text-center col-md-6" id="msg" role="alert" style="width: 300px;">
                {{ Session::get('message') }}
            </div>
            <script>
                setTimeout(function () {
                    var alert = document.querySelector('.alert');
                    alert.style.display = 'none';
                    window.location.href = '/index';
                }, 2500);
            </script>
            @endif
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('showBikeBookForm')}}">Book_Bike</a>
                </li>
                <li class="nav-item active">
                    <!-- <a class="nav-link" data-target="#contactUs" data-toggle="modal">Contact</a> -->
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('logout')}}" id="logout">LogOut</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-2">
        <div id="message-container"></div>
        <div class="card">
            <div class="card-body">
                <div class="bg-info  p-2  m-2">
                    <h5 class="text-center">Booked Bike Details</h5>
                </div>
                <input type="hidden" name="bookingId" id="bookingId">
                <table class="table  table-bordered table-stripted table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <!-- <th scope="col">Name</th> -->
                            <!-- <th scope="col">Email</th> -->
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Per/hr price</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Fine Amount</th>
                            <th scope="col">status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="BookedBikeData">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--contactus Modal -->
    <div class="modal fade" id="contactUs" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="contactUsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactUsLabel">Contact Us - Jk Bikes Rental System</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>If you have any questions or concerns, please feel free to contact us using the form below.</p>
                    <form action="" method="post" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="contactemail" id="contactemail" class="form-control" name="contactemail"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="message">message</label>
                            <textarea name="message" id="message" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="send" class="btn btn-primary">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(() => {

            var firstName = "{{session('firstName')}}";
            var lastName = "{{session('lastName')}}";
            console.log(firstName);
            if (firstName !== "") {
                $('.userName').text(firstName + ' ' + lastName);
            }

            var userId = "{{session('userId')}}"
            $.ajax({
                url: '/fetchBookingById/' + userId,
                type: 'GET',
                success: function (respone) {
                    updateBooking(respone);
                    $.each(respone, function (index, booking) {
                        var id = booking.booking_id;
                        if (booking.status === "need to return") {
                            $.ajax({
                                url: "{{url('calculateFine')}}",
                                type: 'POST',
                                data: { booking_id: id },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {
                                    updateBooking(respone);
                                }
                            })
                        }
                    })
                }
            })
            function updateBooking(respone) {
                $('#BookedBikeData').empty();
                var tr = '';
                $.each(respone, function (index, booking) {
                    tr += '<tr>';
                    // tr += '<td>' + booking.customer_name + '</td>';
                    // tr += '<td>' + booking.customer_email + '</td>';
                    tr += '<td>' + booking.brand_name + '</td>';
                    tr += '<td>' + booking.bike_name + '</td>';
                    tr += '<td>' + booking.wanted_period + ' ' + booking.duration + '</td>';
                    tr += '<td>' + booking.per_hour_rent + ' Rs' + '</td>';
                    tr += '<td>' + booking.total_amount + ' Rs' + '</td>';
                    tr += '<td>' + booking.fine_amount + ' Rs' + '</td>';
                    tr += '<td>' + booking.status + '</td>';
                    if (booking.status === "need to return") {
                        tr += '<td><div class="d-flex">';
                        tr += '<a class="btn btn-success btn-xs py-1" href="/returnVehicle/' + booking.booking_id + '">Return</a>';
                        tr += '</div></td>';
                    }
                    tr += '</tr>';
                })
                $('#BookedBikeData').append(tr);
            }

        })

    </script>

</body>

</html>