@extends('layouts.adminDesign')

@section('content')

    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif
    
<div class="container">
    
   @if (Session::has('createSuccess'))
   <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
     {{ Session::get('createSuccess') }}
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" >&times;</span>
       </button>
   </div>
   @endif


    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>Add Admin Account</div>
            <div><a href="{{ route('adminAccountList') }}"><button class="btn btn-sm btn-dark font-light float-right">View Account List</button></a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('createAdminAccount') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <p style="color:red">{{ $errors->first('name') }}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p style="color:red">{{ $errors->first('email') }}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <p style="color:red">{{ $errors->first('password') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Gender</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="gender" value="{{ old('gender') }}">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                    @if ($errors->has('gender'))
                        <p style="color:red">{{ $errors->first('gender') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Date of Birth</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Date of Birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    @if ($errors->has('date_of_birth'))
                        <p style="color:red">{{ $errors->first('date_of_birth') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number One</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone Number" name="phone_number_one" value="{{ old('phone_number_one') }}">
                    @if ($errors->has('phone_number_one'))
                        <p style="color:red">{{ $errors->first('phone_number_one') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number Two</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone Number" name="phone_number_two" value="{{ old('phone_number_two') }}">
                    @if ($errors->has('phone_number_two'))
                        <p style="color:red">{{ $errors->first('phone_number_two') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Region</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Region" name="region" value="{{ old('region') }}">
                    @if ($errors->has('region'))
                        <p style="color:red">{{ $errors->first('region') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Town</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Town" name="town" value="{{ old('town') }}">
                    @if ($errors->has('town'))
                        <p style="color:red">{{ $errors->first('town') }}</p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address" name="address" value="{{ old('address') }}">
                    @if ($errors->has('address'))
                        <p style="color:red">{{ $errors->first('address') }}</p>
                    @endif
                  </div>
                  
        
                
                <button type="submit" class="btn btn-primary mt-3">Create Account</button>
              </form>
        </div>
</div>
</div>
@endsection