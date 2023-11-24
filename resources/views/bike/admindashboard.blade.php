</h1>
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
                    <a class="nav-link" href="{{url('logout')}}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-2">
        <div id="message-container"></div>
        <div class="card">
            <div class="card-body">
                <div class="bg-success">
                    <span id="newEmployeeAddedMessage"></span>
                </div>
                <div class="bg-info  p-2  m-2">
                    <h5 class="text-dark text-center">Booked Bike Details</h5>
                </div>
                <table class="table  table-bordered table-stripted table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date Of Birth</th>
                            <th scope="col">Age</th>
                            <th scope="col">salary</th>
                            <th scope="col">City</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="Booked_bike_data">
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
                            <input type="email" id="email" class="form-control" name="email" required>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>