@extends('layouts.adminDesign')

@section('content')

    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-2">


   @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    @endif

        <form action="{{ route('sendNoti') }}" method="post">
            @csrf
            <legend class="mb-3">Send Notification to All Teacher</legend>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" ></textarea>
                @if ($errors->has('course_request_details'))
                <p style="color:red">{{ $errors->first('course_request_details') }}</p>
                @endif
            </div>    
            <button type="submit" class="btn btn-primary mt-2">Sent</button>
          </form>
    </div>
@endsection