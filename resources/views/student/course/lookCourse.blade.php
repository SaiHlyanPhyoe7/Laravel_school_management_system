@extends('layouts.studentDesign')

@section('content')
@if(Session::has('authError'))
<p style="color:red">{{ Session::get('authError') }}</p>
@endif

<div class="container-fluid">
    <div class="row mt-1" >
        <legend class="ml-4">Teacher - {{ $courseData[0]->name }}</legend>
      {{-- Card Start --}}
      <div class="col-sm-4 mt-1">
        <div class="card">
          <div class="card-body">
                <h5 class="card-title mt-1">{{ $courseData[0]->course_title }}</h5><hr> 
            <p class="card-text">{{ $courseData[0]->course_explanation }}</p>
            <hr>
            <p class="card-text">{{ $courseData[0]->course_details }}</p>
          </div>
        </div>
      </div> 
    {{-- card end --}}
    </div>
<button class="btn btn-sm btn-warning mt-2" onclick="goBack()">Back</button>
<hr>


    @if (Session::has('classAttendSuccess'))
    <div class="alert alert-success ml-4" role="alert">
      {{ Session::get('classAttendSuccess') }}
    </div>
      @endif
{{-- related class --}}
            <div class="row mt-3" >
                <hr>
                <legend>Related Class</legend>
                {{-- Card Start --}}
                @if($relatedClass != null)
                @foreach ($relatedClass as $item)
                <div class="col-sm-4 mt-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->class_name }}</h5>
                      <p class="card-text">Fee : {{ $item->fee }}</p>
                      <hr> 
                      <p>Class Type : <b>{{ $item->class_type }}</b></p>
                      <p>Time : {{ $item->start_date }} to {{ $item->end_date }}</p>
                      <a href="{{ route('lookClassInformation',[$item->class_id])}}" class="btn btn-success float-right">look Class Information</a>
                    </div>
                  </div>
                </div> 
                @endforeach
                @else
                <div class="alert alert-danger ml-4">There is no related class for this course!</div>
                @endif
              {{-- card end --}}
              </div>
        <div>
            <div style='height:50vh;'></div>
        </div>

  </div>
</div>

@endsection

<script>
   function goBack(){
    window.history.back();
    }
</script>