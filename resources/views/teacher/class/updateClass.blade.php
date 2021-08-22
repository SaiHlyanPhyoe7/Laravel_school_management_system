@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif


   <div class="container mt-5">

    @if (Session::has('courseSuccess'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('courseSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif

    {{-- course form open --}}
    <form action="{{ route('updateClass',$class[0]['class_id']) }}" method="post">
        
    @if (Session::has('updateSuccess'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('updateSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif
        @csrf
        <legend class="mb-3">Update Class</legend>
        <div class="form-group">
            <label>Class Name</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="class_name" value={{old('class_name',$class[0]['class_name'])}} >
            @if ($errors->has('class_name'))
          <p style="color:red">{{ $errors->first('class_name') }}</p>
          @endif
        </div>
        <div class="form-group">
            <label>Class Fee</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="fee" value={{old('fee',$class[0]['fee'])}} >
            @if ($errors->has('fee'))
          <p style="color:red">{{ $errors->first('fee') }}</p>
          @endif        
        </div>
        <div class="form-group">
            <label>Start Time</label>
            <input type="time" class="form-control" id="exampleFormControlTextarea1" rows="3" name="start_time" value={{old('start_time',$class[0]['start_time'])}}>
            @if ($errors->has('start_time'))
          <p style="color:red">{{ $errors->first('start_time') }}</p>
          @endif
        </div>
        <div class="form-group">
            <label>End Time</label>
            <input type="time" class="form-control" id="exampleFormControlTextarea1" rows="3" name="end_time" value={{old('end_time',$class[0]['end_time'])}}>
            @if ($errors->has('end_time'))
          <p style="color:red">{{ $errors->first('end_time') }}</p>
          @endif
        </div>
        <div class="form-group">
            <label>Start Date</label>
            <input type="date" class="form-control" id="exampleFormControlTextarea1" rows="3" name="start_date" value={{old('start_date',$class[0]['start_date'])}}>
            @if ($errors->has('start_date'))
          <p style="color:red">{{ $errors->first('start_date') }}</p>
          @endif
        </div>
        <div class="form-group">
            <label>End Date</label>
            <input type="date" class="form-control" id="exampleFormControlTextarea1" rows="3" name="end_date" value={{old('end_date',$class[0]['end_date'])}}>
            @if ($errors->has('end_date'))
          <p style="color:red">{{ $errors->first('end_date') }}</p>
          @endif
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Class Type</label>
            <select class="form-control" name="class_type">


                @if($class[0]['class_type'] == 'weekday' || old('class_type')=='weekday')
                <option value="weekday" selected>Weekay Class</option>
                <option value="weekend">Weekend Class</option>
                @elseif($class[0]['class_type'] == 'weekend' || old('class_type')=='weekend')
                <option value="weekday">Weekay Class</option>
                <option value="weekend" selected>Weekend Class</option>
                @endif
            </select>
            @if ($errors->has('class_type'))
          <p style="color:red">{{ $errors->first('class_type') }}</p>
          @endif
          </div>   



          @if($class[0]['monday'] == 1 || old('monday')=='true')
          <input type="checkbox" class="form-check-input" name="monday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="monday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Monday</label>

          @if($class[0]['tuesday'] == 1 || old('tuesday')=='true')
          <input type="checkbox" class="form-check-input" name="tuesday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="tuesday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Tuesday</label>

          @if($class[0]['wednesday'] == 1 || old('wednesday')=='true')
          <input type="checkbox" class="form-check-input" name="wednesday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="wednesday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Wednesday</label>

          @if($class[0]['thursday'] == 1 || old('thursday')=='true')
          <input type="checkbox" class="form-check-input" name="thursday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="thursday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Thursday</label>

          @if($class[0]['friday'] == 1 || old('friday')=='true')
          <input type="checkbox" class="form-check-input" name="friday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="friday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Friday</label>

          @if($class[0]['saturday'] == 1 || old('saturday')=='true')
          <input type="checkbox" class="form-check-input" name="saturday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="saturday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Saturday</label>
          @if($class[0]['sunday'] == 1 || old('sunday')=='true')
          <input type="checkbox" class="form-check-input" name="sunday" id="inlineRadio1" value="true" checked>
          @else
          <input type="checkbox" class="form-check-input" name="sunday" id="inlineRadio1" value="true">
          @endif
          <label class="form-check-label mr-4" for="inlineRadio1">Sunday</label>
      <br>   
        <button type="submit" class="btn btn-primary mt-2">Update</button>
      </form>
   </div>
    {{-- course form close --}}


@endsection