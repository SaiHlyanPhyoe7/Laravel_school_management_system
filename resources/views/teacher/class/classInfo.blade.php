@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif

    {{-- course form open --}}
   <div class="container mt-2 mb-10">

    @if (Session::has('createClassSuccess'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('createClassSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif


      <form action="{{ route('createClass') }}" method="post">
        @csrf
        <legend class="mb-3">Create Class</legend>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Course Name</label>
          <select class="form-control" name="course_id">
            @foreach ($course as $item)
                <option value="{{ $item['course_id'] }}">{{ $item['course_title'] }}</option>
            @endforeach
          </select>
        </div>
          <div class="form-group">
            <label>Class Name</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Class Name.." name="class_name" value="{{ old('class_name') }}">
            @if ($errors->has('class_name'))
          <p style="color:red">{{ $errors->first('class_name') }}</p>
          @endif
          </div>
            <div class="form-group">
              <label>Class Fee</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Class fee.." name="fee" value="{{ old('fee')}}">
              @if ($errors->has('fee'))
          <p style="color:red">{{ $errors->first('fee') }}</p>
          @endif
            </div>
            <div class="form-group">
              <label>Start Time</label>
              <input type="time" class="form-control" aria-describedby="emailHelp" placeholder="Enter Start Time.." name="start_time" value="{{ old('start_time')}}">
              @if ($errors->has('start_time'))
          <p style="color:red">{{ $errors->first('start_time') }}</p>
          @endif
            </div>
            <div class="form-group">
              <label>End Time</label>
              <input type="time" class="form-control" aria-describedby="emailHelp" placeholder="Enter End Time.." name="end_time" value="{{ old('end_time')}}">
              @if ($errors->has('end_time'))
          <p style="color:red">{{ $errors->first('end_time') }}</p>
          @endif
            </div>
            <div class="form-group">
              <label>Start Date</label>
              <input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Start Date.." name="start_date" value="{{ old('start_date')}}">
              @if ($errors->has('start_date'))
          <p style="color:red">{{ $errors->first('start_date') }}</p>
          @endif
            </div>
            <div class="form-group">
              <label>End Date</label>
              <input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter End Date.." name="end_date" value="{{ old('end_date') }}">
              @if ($errors->has('end_date'))
          <p style="color:red">{{ $errors->first('end_date') }}</p>
          @endif
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Class Type</label>
              <select class="form-control" name="class_type">
                @if(old('class_type')== 'weekday')
                <option value="weekday" selected>Weekday Class</option>
                <option value="weekend" >Weekend Class</option>
                @else
                <option value="weekday">Weekday Class</option>
                <option value="weekend" selected>Weekend Class</option>
                @endif
              </select>
              @if ($errors->has('class_type'))
              <p style="color:red">{{ $errors->first('class_type') }}</p>
              @endif
            </div>
            
            <div class="form-check form-check-inline">
              @if(old('monday') == "true")
              <input type="checkbox" class="form-check-input" name="monday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="monday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Monday</label>
            </div>

            <div class="form-check form-check-inline">
              @if(old('tuesday') == "true")
              <input type="checkbox" class="form-check-input" name="tuesday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="tuesday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Tuesday</label>
            </div>

            <div class="form-check form-check-inline">
              @if(old('wednesday') == "true")
              <input type="checkbox" class="form-check-input" name="wednesday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="wednesday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Wednesday</label>
            </div>

            <div class="form-check form-check-inline">
              @if(old('thursday') == "true")
              <input type="checkbox" class="form-check-input" name="thursday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="thursday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Thursday</label>
            </div>

            <div class="form-check form-check-inline">
              @if(old('friday') == "true")
              <input type="checkbox" class="form-check-input" name="friday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="friday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Friday</label>
            </div>

            <div class="form-check form-check-inline">
              @if(old('saturday') == "true")
              <input type="checkbox" class="form-check-input" name="saturday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="saturday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Saturday</label>
            </div>

            <div class="form-check form-check-inline">
              @if(old('sunday') == "true")
              <input type="checkbox" class="form-check-input" name="sunday" value="true" checked>
              @else
              <input type="checkbox" class="form-check-input" name="sunday" value='true'>
              @endif
              <label class="form-check-label mr-4" for="inlineRadio1">Sunday</label>
            </div>
{{-- 
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="tuesday" value="true">
              <label class="form-check-label mr-4" for="inlineRadio1">Tuesday</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="wednesday" value="true">
              <label class="form-check-label mr-4" for="inlineRadio1">Wednesday</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="thursday" value="true">
              <label class="form-check-label mr-4" for="inlineRadio1">Thursday</label>
            </div>
            
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="friday" value="true">
              <label class="form-check-label mr-4" for="inlineRadio1">Friday</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="saturday" value="true">
              <label class="form-check-label mr-4" for="inlineRadio1">Saturday</label>
            </div>

            <div class="form-check form-check-inline mt-3">
              <input type="checkbox" class="form-check-input" name="sunday" value="true">
              <label class="form-check-label mr-4" for="inlineRadio1">Sunday</label>
            </div> --}}
        <br>
            <button type="submit" class="btn btn-primary mt-2">Create Class</button>
      </form>
      <br>
      <br>
   </div>
    {{-- course form close --}}


@endsection