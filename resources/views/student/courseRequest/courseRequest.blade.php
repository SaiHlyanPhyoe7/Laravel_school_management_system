@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif
   {{-- course form open --}}
   <div class="container mt-5">

    @if (Session::has('createSuccess'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('createSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif

    

    <form action="{{ route('requestCourse') }}" method="post">
        @csrf
        <legend class="mb-3">Course Request</legend>
        <div class="form-group">
            <label>Request Course Title</label>
            <input type="text" class="form-control" rows="3" placeholder="Enter Course Title.." name="course_request_title" value="{{ old('course_request_title') }}">
            @if ($errors->has('course_request_title'))
            <p style="color:red">{{ $errors->first('course_request_title') }}</p>
            @endif
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Request Course Detail</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="course_request_details" value="{{ old('course_request_details') }}"></textarea>
            @if ($errors->has('course_request_details'))
            <p style="color:red">{{ $errors->first('course_request_details') }}</p>
            @endif
        </div>    
        <button type="submit" class="btn btn-primary mt-2">Request</button>
      </form><br><br>

   </div>
    {{-- course form close --}}


@endsection