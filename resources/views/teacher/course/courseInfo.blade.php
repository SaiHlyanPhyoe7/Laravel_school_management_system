@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif

    {{-- course form open --}}
   <div class="container mt-5">

    @if (Session::has('courseSuccess'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('courseSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('createCourse') }}" method="post">
        @csrf
        <legend class="mb-3">Create Course</legend>
        <div class="form-group">
            <label>Course Title</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Course Title.." name="course_title" value="{{ $sessionData['course_title'] }}">
          @if ($errors->has('course_title'))
          <p style="color:red">{{ $errors->first('course_title') }}</p>
          @endif
          </div>
          <div class="form-group">
            <label>Course Explanation</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  placeholder="Enter Course Explanation.." name="course_explanation" value="">{{ $sessionData['course_explanation'] }}</textarea>
            @if ($errors->has('course_explanation'))
            <p style="color:red">{{ $errors->first('course_explanation') }}</p>
            @endif
          </div>
          <div class="form-group">
            <label>Course Details</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Course Details" name="course_details" value="">{{ $sessionData['course_details'] }}</textarea>
            @if ($errors->has('course_details'))
            <p style="color:red">{{ $errors->first('course_details') }}</p>
            @endif
          </div>

        <button type="submit" class="btn btn-primary mt-2">Create Course</button>
      </form>
   </div>
    {{-- course form close --}}


@endsection