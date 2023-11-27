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

        .contactForm {
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
                    <a class="nav-link" data-target="#contactUs" data-toggle="modal">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="">
        <h1 style="color:white">Welcome to JK Bike Rendle System</h1>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-end center-container">
            <div class="col-md-4">
                @if(Session::has('indexmessage'))
                <div class="alert alert-danger text-center ml-auto" id="msg" role="alert" style="width: 300px;">
                    {{ Session::get('indexmessage') }}
                </div>
                <script>
                    setTimeout(function () {
                        var alert = document.querySelector('.alert');
                        alert.style.display = 'none';
                    }, 5000);
                </script>
                @endif
                <form action="{{url('verifyCustomer')}}" method="post" class="indexLogin ml-auto">
                    <h4 class="text-center text-success">Login Form</h4>
                    <hr>
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="- Email Address -"
                          value="{{old('email') ? : ''}}"  required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="- Password -" required>
                    </div>
                    <div class="form-group">
                        <label for="loginType">Login Type</label> &nbsp; <b>:</b> &nbsp; &nbsp;
                        <input type="radio" name="type" id="User" value="user"><label for="User">&nbsp;&nbsp;User</label> &nbsp;
                        &nbsp;
                        <input type="radio" name="type" id="Admin" value="admin"><label for="Admin">&nbsp;&nbsp;Admin</label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="submit" value="Login"
                            class="btn btn-primary btn-xs py-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="left: 50px;">Not a member ? <a href="{{url('register')}}">Sign up </a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
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

                    <form action="" method="post" class="contactForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contactemail">Email:</label>
                            <input type="email" id="contactemail" class="form-control" name="contactemail" required>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>