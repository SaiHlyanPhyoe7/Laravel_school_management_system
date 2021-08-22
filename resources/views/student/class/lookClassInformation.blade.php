@extends('layouts.studentDesign')

@section('content')
@if(Session::has('authError'))
<p style="color:red">{{ Session::get('authError') }}</p>
@endif

<div class="container-fluid">
    <div class="row mt-1" >
        <legend class="ml-4"></legend>
      {{-- Card Start --}}
      <div class="col-sm-4 mt-1">
        <div class="card">
          <div class="card-body">
                <h5 class="card-title"><label>Class Title - {{ $class[0]->class_name }}</label></h5><hr> 
            <p class="card-text">Class Fee {{ $class[0]->fee }}</p>
            <hr>
            <p class="card-text">Start Time - {{ $class[0]->start_time }}</p>
            <p class="card-text">End Time - {{ $class[0]->end_time }}</p>
            <p class="card-text">Start Date - {{ $class[0]->start_date }}</p>
            <p class="card-text">End Date - {{ $class[0]->end_date }}</p>
            <p class="card-text">Class Type - {{ $class[0]->class_type }}</p>
            <hr>
            @if ($status == 2)
            <p style="color: green">You Can Try This Class!</p>
            @elseif ($status == 3)
            <p style="color: orange">Class is already full!</p>
            @elseif ($status == 4)
            <p style="color: red">Teacher Reject this class</p>
            @elseif($status == 0)
            <a href="{{ route ('enrollClass',[$class[0]->class_id, $class[0]->user_id]) }}" class="btn btn-success float-right">Enroll</a>
            @else
            <p style="color:blue">Wait for Teacher's response!</p>
            @endif
          </div>
        </div>
      </div> 
    {{-- card end --}}
    </div> 
<button class="btn btn-sm btn-warning mt-2" onclick="goBack()">Back</button>
<hr>

</div>

@endsection

<script>
   function goBack(){
    window.history.back();
    }
</script> 