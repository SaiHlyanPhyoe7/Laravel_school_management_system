@extends('layouts.studentDesign')

@section('content')
@if(Session::has('authError'))
<p style="color:red">{{ Session::get('authError') }}</p>
@endif

<div class="container-fluid">
  <div class="mt-4">
    {{ $course->links() }}
  </div>
    <div class="row mt-3" >
      {{-- Card Start --}}
      @foreach ($course as $item)
      <div class="col-sm-4 mt-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $item->course_title }}</h5>
            <p class="card-text">{{ $item->course_explanation }}</p>
            <p class="card-text">Teacher - <b>{{ $item->name }}</b></p>
            <a href="{{ route('lookCourse', $item->course_id) }}" class="btn btn-success float-right">Look Info</a>
          </div>
        </div>
      </div> 
      @endforeach
    {{-- card end --}}
    </div>
  </div>
</div>

@endsection