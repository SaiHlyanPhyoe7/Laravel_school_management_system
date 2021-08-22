@extends('layouts.studentDesign')

@section('content')
@if(Session::has('authError'))
<p style="color:red">{{ Session::get('authError') }}</p>
@endif

<div class="container-fluid">

    @section('content')
    @if(Session::has('classAttendSuccess'))
    <div class="alert alert-success">{{ Session::get('classAttendSuccess') }}</div>
    @endif
    <div class="row mt-3" >
        {{ $class->links() }}
        @foreach ($class as $item)
        <div class="col-sm-4 mt-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $item->class_name }}</h5>
              <p class="card-text">Fee : {{ $item->fee }}</p>
              <hr> 
              <p>Class Type : <b>{{ $item->class_type }}</b></p>
              <p>Time : {{ $item->start_date }} to {{ $item->end_date }}</p>
              <p>Teacher : {{ $item->name }}</p>
                <a href="{{ route('lookClassInformation',[$item->class_id])}}" class="btn btn-success float-right">look Class Information</a>
            </div>
          </div>
        </div> 
        @endforeach

    </div>
</div>

@endsection