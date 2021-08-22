@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif
   {{-- course form open --}}
   <div class="container mt-5">

    @if (Session::has('updateSuccess'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('updateSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif

    

    <form action="{{ route('updateProfile', $teacherInfo[0]['id']) }}" method="get">
        @csrf
        <legend class="mb-3">Edit Profile</legend>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" rows="3" placeholder="Enter Course Title.." name="name" value="{{ old('name', $teacherInfo[0]['name']) }}">
            @if ($errors->has('name'))
          <p style="color:red">{{ $errors->first('name') }}</p>
          @endif
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" rows="3" placeholder="Enter Email Name.." name="email" value="{{ old('email', $teacherInfo[0]['email']) }}">
            @if ($errors->has('email'))
            <p style="color:red">{{ $errors->first('email') }}</p>
            @endif
        </div>
          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" class="form-control" rows="3" placeholder="Enter Date of Birth.." name="date_of_birth" value="{{ old('date_of_birth', $teacherInfo[0]['date_of_birth']) }}">
            @if ($errors->has('date_of_birth'))
            <p style="color:red">{{ $errors->first('date_of_birth') }}</p>
            @endif
        </div>
          <div class=" form-group  mt-1 mb-1 " >
            <label>Gender : </label>
            <select class="custom-select my-1 mr-sm-2" name="gender">
                @if ($teacherInfo[0]['gender']=='male')
                <option selected value="male">Male</option>
                <option value="female">Female</option>
                @else
                <option selected value="male">Male</option>
                <option value="female" selected>Female</option>
                @endif
              </select>
              @if ($errors->has('gender'))
            <p style="color:red">{{ $errors->first('gender') }}</p>
            @endif
          </div>
          <div class="form-group">
            <label>Primary Phone Number</label>
            <input type="number" class="form-control" rows="3" placeholder="Enter Phone Number One.." name="phone_number_one" value="{{ old('phone_number_one', $teacherInfo[0]['phone_number_one']) }}">
            @if ($errors->has('phone_number_one'))
            <p style="color:red">{{ $errors->first('phone_number_one') }}</p>
            @endif
        </div>
          <div class="form-group">
            <label>Secondary Phone Number</label>
            <input type="number" class="form-control" rows="3" placeholder="Enter Phone Number Two.." name="phone_number_two" value="{{ old('phone_number_two', $teacherInfo[0]['phone_number_two']) }}">
            @if ($errors->has('phone_number_two'))
            <p style="color:red">{{ $errors->first('phone_number_two') }}</p>
            @endif
        </div>
          <div class="form-group">
            <label>Region</label>
            <input type="text" class="form-control" rows="3" placeholder="Enter Region.." name="region" value="{{ old('region', $teacherInfo[0]['region']) }}">
          
            @if ($errors->has('region'))
            <p style="color:red">{{ $errors->first('region') }}</p>
            @endif
        </div>
          <div class="form-group">
            <label>Town</label>
            <input type="text" class="form-control" rows="3" placeholder="Enter Town.." name="town" value="{{ old('town', $teacherInfo[0]['town']) }}">
            @if ($errors->has('town'))
            <p style="color:red">{{ $errors->first('town') }}</p>
            @endif
        </div>
        
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" rows="3" placeholder="Enter Address.." name="address" value="{{ old('address', $teacherInfo[0]['address']) }}">
          
            @if ($errors->has('address'))
            <p style="color:red">{{ $errors->first('address') }}</p>
            @endif
        </div><br>
          <a href="{{ route('changePassword') }}">Change Password</a><br>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
      </form><br><br>

   </div>
    {{-- course form close --}}


@endsection