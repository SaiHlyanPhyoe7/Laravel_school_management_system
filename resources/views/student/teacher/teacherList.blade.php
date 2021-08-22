@extends('layouts.studentDesign')

@section('content')
@if(Session::has('authError'))
<p style="color:red">{{ Session::get('authError') }}</p>
@endif

<div class="container-fluid">
  <div class="mt-4">
    {{ $teacher->links() }}
  </div>
    <div class="row mt-3" >
        {{-- Card Start --}}
      @foreach ($teacher as $item)
      <div class="col-sm-4 mt-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Name - {{ $item->name }}</h5>
            <p class="card-text">Phone Number - {{ $item->phone_number_one }}</p>
            <p class="card-text">Region - <b>{{ $item->region }}</b></p>
            <a href="{{ route('teacherRelatedCourse',$item->id) }}" class="btn btn-success float-right">Look Info</a>
          </div>
        </div>
      </div> 
      @endforeach
    {{-- card end --}}
    </div>
</div>

@endsection