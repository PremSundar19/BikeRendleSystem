@extends('layout.form')
@section('content')

<body class="registration">
    <div class="container mt-5">
        <div class="row justify-content-center center-container">
            <div class="col-md-7">
                <form action="{{url('storeCustomer')}}" method="post" class="form">
                    <h4 class="text-center text-success">Register a new membership</h4>
                    <hr>
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="firstname" id="firstname"
                                class="form-control @error('firstname') is-invalid @enderror"
                                placeholder="- First Name -">
                            @error('firstname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="middlename" id="middlename" class="form-control"
                                placeholder="- Middle Name -">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="lastname" id="lastname" class="form-control"
                                placeholder="- Last Name -">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" name="dob" id="dob"
                                class="form-control @error('dob') is-invalid @enderror">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="age" id="age"
                                class="form-control @error('age') is-invalid @enderror" placeholder="- Your Age -"
                                readonly>
                            @error('age')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                <option>- choose -</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="- Email Address -">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="contactno" id="contactno"
                                class="form-control @error('contactno') is-invalid @enderror "
                                placeholder="- Contact Number -">
                            @error('contactno')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6"> <input type="text" name="username" id="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="- username -">
                            <span class="text-danger">Ex : firstname and last number (ajay7855)</span>
                            @error('username')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6"> <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="- password -">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                    <!-- <input type="submit" value="Register" class="btn btn-primary btn-xs py-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                          
                        <button type="submit" class="btn btn-primary py-1">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="left: 50px;">already a member ? <a href="#">Log in </a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection