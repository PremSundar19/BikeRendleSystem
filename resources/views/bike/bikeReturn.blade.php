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
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row content-justify-center center-container">
            <div class="col-md-5">
                <form action="" method="post" class="form">
                    <h4 class="text-success"></h4>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" name="name" id="name" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Customer Email</label>
                            <input type="email" class="form-control" name="email" id="email" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="brand">Brand Name</label>
                            <input type="text" class="form-control" name="brand" id="brand" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="bikename">Bike Name</label>
                            <input type="text" class="form-control" name="bikename" id="bikename" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="paidamount">Paid Amount</label>
                            <input type="text" class="form-control" name="paidamount" id="paidamount" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="fineamount">Fine Amount</label>
                            <input type="text" class="form-control" name="fineamount" id="fineamount" readonly>
                        </div>
                    </div>
                    <div class="form-group" id="button">
                        <input type="submit" value="Return" class="btn btn-primary">
                        <a href="{{url('dashboard')}}" class="btn btn-success">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
 
</script>
</body>

</html>