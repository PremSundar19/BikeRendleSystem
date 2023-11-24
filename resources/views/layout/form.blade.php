<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(55, 75, 85, 0.5);
        }

        .red {
            background-color: red;
            color: white;
        }

        .registration {
            background-image: url('image/registration.jpg');
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

        .center-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-control {
            margin-bottom: 10px;
            text-align: center;
        }


        .navbar {
            background-color: #333;
        }

        .navbar-brand img {
            height: 30px;
            width: auto;
            margin-right: 10px;
        }
        .black{
            color : black;
        }

        .red{
            color:white;
            background-color : red;
        }
        
        .green{
            color:white;
            background-color : green;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function calculateAge(dobInput, ageInput, dobError) {
    
            var dob = new Date($(dobInput).val());
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            if ((dob.getFullYear() > today.getFullYear()) || (dob.getFullYear() === today.getFullYear() && dob.getMonth() > today.getMonth()) || (dob.getFullYear() === today.getFullYear() && dob.getMonth() === today.getMonth() && dob.getDate() > today.getDate())) {
                $(dobError).text('* please select proper date');
                $(ageInput).val('');
            } else {
                if ((today.getMonth() < dob.getMonth()) || (dob.getMonth() === today.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }
                $(dobError).text('');
                $(ageInput).val(age);
            }
        }
    </script>
</head>
@yield('content')

</html>