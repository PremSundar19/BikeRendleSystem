@extends('layout.form')
    @section('content')
    <body>
    <div class="container mt-5">
        <div class="row justify-content-center center-container">
            <div class="col-md-4">
                <form action="" method="post" class="form">
                    <h4 class="text-center text-success">Login Form</h4>
                    <hr>
                    @csrf                
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="- User Name -">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="- password -">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="loginType">Login Type</label> &nbsp; <b>:</b> &nbsp; &nbsp;
                        <input type="radio" name="User" id="User"><label for="User">&nbsp;&nbsp;User</label>  &nbsp; &nbsp;
                        <input type="radio" name="Admin" id="Admin"><label for="Admin">&nbsp;&nbsp;Admin</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary py-1">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    </body>
    @endsection