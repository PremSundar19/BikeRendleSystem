@extends('layout.form')
@section('content')

<body class="registration">
    <div class="container mt-5">
        <div class="row justify-content-center center-container">
            <div class="col-md-5">
                @if(Session::has('message'))
                <div class="alert alert-success justify-content-center text-center" id="msg" role="alert">
                    {{ Session::get('message') }}
                </div>
                <script>
                    setTimeout(function () {
                        var alert = document.querySelector('.alert');
                        alert.style.display = 'none';
                        window.location.href = '/index';
                    }, 5000);
                </script>
                @endif
                <form action="{{url('storeCustomer')}}" method="post" class="form">
                    <h4 class="text-center text-success">Register a new membership</h4>
                    <hr>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="firstname" id="firstname"
                                class="form-control @error('firstname') is-invalid @enderror"
                                placeholder="- First Name -">
                            @error('firstname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="lastname" id="lastname" class="form-control"
                                placeholder="- Last Name -">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="date" name="dob" id="dob"
                                class="form-control @error('dob') is-invalid @enderror">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span class="text-danger dobError"></span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="age" id="age"
                                class="form-control @error('age') is-invalid @enderror" placeholder="- Your Age -"
                                readonly>
                            @error('age')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <script>
                            $(document).ready(() => {
                                $('#dob').on('change', () => {
                                    calculateAge('#dob', '#age', '.dobError');
                                })
                            })
                        </script>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="- Email Address -">
                            @error('email')
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
                        <button type="submit"
                            class="btn btn-primary py-1">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="left: 50px;">already a member ? <a href="{{url('index')}}">Log in </a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection