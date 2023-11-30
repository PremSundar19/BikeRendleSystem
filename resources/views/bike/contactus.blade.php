@extends('layouts.form')
@section('content')

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        @if(Session::has('message'))
        <div class="alert alert-{{Session::get('class')}} justify-content-justify" role="alert">
          {{ Session::get('message') }}
        </div>
        <script>
          setTimeout(function() {
            var alert = document.querySelector('.alert');
            alert.style.display = 'none';
            var status = "{{session::get('status')}}";
            if (status) {
              window.location.href = '/admindashboard';
            }
          }, 4000);
        </script>
        @endif
        <form action="{{url('bookAppointment')}}" class="appointmentform black" method="post">
          @csrf
          <h5 class="Appointmenttitle">New Patient Appointment Form</h5>
          <div class="row">
            <input type="hidden" name="doctor_id" id="doctor_id">
            <div class="col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}">
              @error('first_name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name') ? : ''}}">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="dob" class="form-label">DOB</label>
              <input type="date" name="dob" id="dob" class="form-control  @error('dob') is-invalid @enderror" value="{{old('dob') ? : ''}}">
              @error('dob')
              <span class="text-danger">{{$message}}</span>
              @enderror
              <span class="text-danger" id="dobError"></span>
            </div>
            <div class="col-md-6">
              <label for="age" class="form-label">Age</label>
              <input type="number" name="age" id="age" class="form-control  @error('age') is-invalid @enderror" value="{{old('age') ? : ''}}" readonly>
              @error('age')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="patient_mobile" class="form-label">Mobile</label>
              <input type="text" name="patient_mobile" id="patient_mobile" class="form-control  @error('patient_mobile') is-invalid @enderror" value="{{old('patient_mobile') ? : ''}}">
              @error('patient_mobile')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option>choose</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
              </select>
              @error('gender')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-12">
            <label for="appointment_date" class="form-label">Appointment date</label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control  @error('appointment_date') is-invalid @enderror" value="{{old('appointment_date') ? : ''}}">
            <span id="appointment_dateError" class="text-danger"></span>
            @error('appointment_date')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="Specialists">Specialists</label>
              <select name="Specialists" id="Specialists" class="form-select @error('Specialists') is-invalid @enderror">
                <option>Choose...</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Dermatology">Dermatology</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Accident and emergency medicine">Accident and emergency medicine</option>
              </select>
              @error('Specialists')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6 d" style="display: none;">
              <label for="doctor_name">Doctor name</label>
              <select name="doctor_name" id="doctor_name" class="form-select displayDoctors">
              </select>
            </div>
          </div>
          <br>
          <div class="form-group">
            <input type="submit" value="Book-Appointment" class="btn btn-primary btn-xs py-0">
            <a href="{{url('admindashboard')}}" class="btn btn-secondary btn-xs py-0">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
@endsection