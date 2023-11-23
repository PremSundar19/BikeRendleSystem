<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JkBikes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .index {
            background-image: url('ktm/bike.jpg');
        }

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

        .indexLogin {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(55, 75, 85, 0.5);
        }

        .form-control {
            text-align: center;
        }
    </style>
</head>

<body class="index">

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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('contactUs')}}">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="">
        <h1 style="color:white">Welcome to JK Bike Rendle System</h1>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-end center-container ">
            <div class="col-md-4">

                <form action="" method="post" class="indexLogin ml-auto">
                    <h4 class="text-center text-success">Login Form</h4>
                    <hr>
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username"
                            placeholder="- User Name -">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="- password -">
                    </div>
                    <div class="form-group">
                        <label for="loginType">Login Type</label> &nbsp; <b>:</b> &nbsp; &nbsp;
                        <input type="radio" name="User" id="User"><label for="User">&nbsp;&nbsp;User</label> &nbsp;
                        &nbsp;
                        <input type="radio" name="Admin" id="Admin"><label for="Admin">&nbsp;&nbsp;Admin</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login"
                            class="btn btn-primary btn-xs py-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="left: 50px;">Not a member ? <a href="#">Sign up </a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Contact Us - Jk Bikes Rental System</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1></h1>
                    <p>If you have any questions or concerns, please feel free to contact us using the form below.</p>

                    <form action="#" method="post">
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
                            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Submit"  class="btn btn-primary">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>