@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif
   {{-- course form open --}}
   <div class="container mt-5">
@include('teacher.profile.changePasswordError')

  
    <form action="{{ route('changePassswordbyME') }}" method="post">
        @csrf
        <legend class="mb-3">Change Password</legend>
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" rows="3" name="old_password" value="{{ old('old_password') }}">
            @if ($errors->has('old_password'))
          <p style="color:red">{{ $errors->first('old_password') }}</p>
          @endif
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" rows="3" name="new_password" value="{{ old('new_password') }}">
            @if ($errors->has('new_password'))
          <p style="color:red">{{ $errors->first('new_password') }}</p>
          @endif
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" rows="3" name="confirm_password" value="{{ old('confirm_password') }}">
            @if ($errors->has('confirm_password'))
          <p style="color:red">{{ $errors->first('confirm_password') }}</p>
          @endif
        </div>
        <button type="submit" class="btn btn-primary mt-2">Change</button>
      </form><br><br>

   </div>
    {{-- course form close --}}


@endsection