@extends('layout.form')
@section('content')

<body>
    <div class="container mt-5">

        <div class="row justify-content-center center-container">
            <div class="col-md-5">
                <div id="message-container"></div>
                @if(Session::has('message'))
                <div class="alert alert-success justify-content-center text-center" id="msg" role="alert">
                    {{ Session::get('message') }}
                </div>
                <script>
                    setTimeout(function () {
                        var alert = document.querySelector('.alert');
                        alert.style.display = 'none';
                        var isTrue = "{{Session::get('class')}}";
                        if (isTrue) {
                            window.location.href = '/dashboard';
                        }
                    }, 3500);
                </script>
                @endif
                <form action="{{url('storeBooking')}}" method="post" class="form">
                    <h2 class="text-center text-success" style="display:inline;"><b>Book Bike</b></h2>
                    <!-- <hr> -->
                    @csrf
                    <input type="hidden" name="bikeId" id="bikeId">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="- Your Name -">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="- Email Address -">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Dob</label>
                            <input type="date" name="dob" id="dob"
                                class="form-control @error('dob') is-invalid @enderror">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span class="text-danger dobError"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Age</label>
                            <input type="number" name="age" id="age"
                                class="form-control @error('age') is-invalid @enderror" placeholder="- Your Age -"
                                readonly>
                            @error('age')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="brand" class="form-label">Select Brand</label>
                            <select name="brand" id="brand" class="form-control">
                                <option>- choose -</option>
                                <option value="Yamaha">Yamaha</option>
                                <option value="Honda">Honda</option>
                                <option value="Ktm">Ktm</option>
                                <option value="Bajaj">Bajaj</option>
                                <option value="Royal Enfield">Royal Enfield</option>
                                <option value="Tvs">Tvs</option>
                                <option value="Hero">Hero</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="bike" class="form-label">Select Model</label>
                            <select name="bike" id="bike" class="form-control listOfBike">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Select Duration</label>
                            <select name="duration" id="duration" class="form-control">
                                <option>- choose -</option>
                                <option value="Hour">Hour</option>
                                <option value="Day">Day</option>
                                <option value="Week">Week</option>
                                <option value="Month">Month</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="wantedPeriod" class="form-label"> Wanted Period </label>
                            <input type="number" name="wantedPeriod" id="wantedPeriod" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rate" class="form-label">Per Hour Rent</label>
                            <input type="text" name="rate" id="rate" class="form-control"
                                placeholder="- Rate for per-hr -" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="amount" class="form-label">Total Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="- Amount -"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile form-label">mobile</label>
                        <input type="mobile" id="mobile" class="form-control" name="mobile"
                            placeholder="- Mobile Number -">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Book" class="btn btn-primary">
                        <a href="{{url('dashboard')}}" class="btn btn-success">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            calculateAge('#dob', '#age', '.dobError');
            checkEligible();
            $('#brand').on('change', () => {
                var brand = $('#brand option:selected').val().toLowerCase();
                $.ajax({
                    url: '/fetchBikes/' + brand,
                    type: 'GET',
                    success: function (respone) {
                        $('.listOfBike').empty();
                        var option = '<option>- choose -</option>';
                        $.each(respone, function (index, bike) {
                            option += '<option value="' + bike.bikename + '">' + bike.bikename + '</option>';
                        })
                        $('.listOfBike').append(option);
                    }
                });
            })
            function checkEligible() {
                var age = $('#age').val();
                if (age < 18) {
                    $('#message-container').html('<div class="alert alert-danger text-center">Your not eligible to book bike</div>');
                    setTimeout(() => {
                        $('#message-container').empty();
                    }, 4000);
                }
            }

            $('#bike').on('change', () => {
                var bike = $('#bike option:selected').val();
                $.ajax({
                    url: '/fetchBikePerCharge/' + bike,
                    type: 'GET',
                    success: function (respone) {
                        $.each(respone, function (index, bike) {
                            $('#bikeId').val(bike.id);
                            $('#rate').val(bike.perhour);
                        })
                    }
                });
            })

            $('#wantedPeriod').on('change', () => {
                var perHourCost = $('#rate').val();
                var wantedPeriod = parseFloat($('#wantedPeriod').val());
                var duration = $('#duration option:selected').val();
                var total = 1;
                if (duration === "Hour") {
                    total *= perHourCost * wantedPeriod;
                } else if (duration === "Day") {
                    
                } else if (duration === "Week") {

                } else if (duration === "Month") {

                }
                $('#amount').val(total);
                console.log('perhourcost : ' + perHourCost + ', wantriotedPeriod : ' + wantedPeriod + ', duration : ' + duration);
            })

        })
    </script>

</body>
@endsection