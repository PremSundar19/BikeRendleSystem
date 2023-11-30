@extends('layout.form')
@section('content')

<body>
    <div class="container mt-3">
        <div class="row justify-content-center center-container">
            <div class="col-md-5">
                <form action="{{url('saveBooking')}}" method="post" class="form">
                <div id="message-container"></div>
                    <h3 class="text-center text-success">Book Bike Enjoy The Ride</h3>
                    @csrf
                    <input type="hidden" name="bikeId" id="bikeId">
                    <input type="hidden" name="userId" id="userId" value="{{session('userId')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="- Your Name -">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control  @error('email') is-invalid @enderror"
                                name="email" placeholder="- Email Address -">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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
                            <select name="brand" id="brand" class="form-control  @error('brand') is-invalid @enderror">
                                <option>- choose -</option>
                                <option value="Yamaha">Yamaha</option>
                                <option value="Honda">Honda</option>
                                <option value="Ktm">Ktm</option>
                                <option value="Bajaj">Bajaj</option>
                                <option value="Royal Enfield">Royal Enfield</option>
                                <option value="Tvs">Tvs</option>
                                <option value="Hero">Hero</option>
                            </select>
                            @error('brand')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="bike" class="form-label">Select Bike</label>
                            <select name="bike" id="bike"
                                class="form-control listOfBike  @error('bike') is-invalid @enderror">
                            </select>
                            @error('bike')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Select Duration</label>
                            <select name="duration" id="duration"
                                class="form-control  @error('duration') is-invalid @enderror">
                                <option>- choose -</option>
                                <option value="Hour">Hour</option>
                                <option value="Day">Day</option>
                                <option value="Week">Week</option>
                            </select>
                            <span class="text-danger selectDuration"></span>
                            @error('duration')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="wantedPeriod" class="form-label"> Wanted Period </label>
                            <input type="number" name="wantedPeriod" id="wantedPeriod"
                                class="form-control  @error('wantedPeriod') is-invalid @enderror">
                            @error('wantedPeriod')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rate" class="form-label">Per Hour Rent</label>
                            <input type="text" name="rate" id="rate"
                                class="form-control  @error('rate') is-invalid @enderror"
                                placeholder="- Rate for per-hr -" readonly>
                            @error('rate')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="amount" class="form-label">Total Amount</label>
                            <input type="number" name="amount" id="amount"
                                class="form-control  @error('amount') is-invalid @enderror" placeholder="- Amount -"
                                readonly>
                            @error('amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile form-label">mobile</label>
                        <input type="number" id="mobile" class="form-control  @error('mobile') is-invalid @enderror"
                            name="mobile" placeholder="- Mobile Number -">
                        @error('mobile')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="2" name="address"></textarea>
                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Book" class="btn btn-primary">
                        <a href="{{url('dashboard')}}" class="btn btn-success">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#dob').on('change', () => {
                calculateAge('#dob', '#age', '.dobError');
            })

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

            $('#bike').on('click', () => {
                $.ajax({
                    url: 'fetchBookings',
                    type: 'GET',
                    success: function (respone) {
                        $('#bike option').each(function () {
                            var bikeName = $(this).val();
                            var matchBike = respone.find(bike => bikeName === bike.bike_name && bike.status === "need to return");
                            if (bikeName === "- choose -") {
                                $(this).addClass('black');
                            } else if (matchBike) {
                                $(this).addClass('red');
                            } else {
                                $(this).addClass('green');
                            }
                        })
                    }
                });
            })

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

            $('#bike').on('click', () => {
                var bike = $('#bike option:selected').val();
                $.ajax({
                    url: '/checkAvailable/' + bike,
                    type: 'GET',
                    success: function (respone) {
                        console.log(respone);
                        if (respone.isExists) {
                            $('#message-container').html('<div class="alert alert-danger text-center">Sorry ' + bike + ' is not available</div>');
                            setTimeout(() => {
                                $('#message-container').empty();
                            }, 4000);
                            $('#bike').val('- choose -');
                            $('#rate').val('');
                        }
                    }
                })
            })

            $('#wantedPeriod').on('change', () => {
                var perHourCost = parseFloat($('#rate').val());
                var wantedPeriod = parseFloat($('#wantedPeriod').val());
                var duration = $('#duration option:selected').val();
                if (duration === '- choose -') {
                    $('.selectDuration').text('* please select duration');
                    $('#wantedPeriod').val('');
                } else {
                    $('.selectDuration').text('');
                }
                var total = 1;
                if (duration === "Hour") {
                    total *= perHourCost * wantedPeriod;
                } else if (duration === "Day") {
                    total *= perHourCost * wantedPeriod * 24;
                } else if (duration === "Week") {
                    total *= perHourCost * wantedPeriod * 24 * 7;
                } else if (duration === "Month") {
                    total *= perHourCost * wantedPeriod * 24 * 30;
                }
                if (!isNaN(total) && duration !== '- choose -') {
                    $('#amount').val(total);
                }
                console.log('perhourcost : ' + perHourCost + ', wantriotedPeriod : ' + wantedPeriod + ', duration : ' + duration);
            })

            $('.form').on('submit', function (event) {
                event.preventDefault();
                var age = parseInt($('#age').val());
                if (age < 18) {
                    $('#message-container').html('<div class="alert alert-danger text-center">You are not eligible to book a bike.</div>');
                    setTimeout(() => {
                        $('#message-container').empty();
                    }, 4000);
                } else {
                    this.submit();
                }
            });
        })
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
@endsection