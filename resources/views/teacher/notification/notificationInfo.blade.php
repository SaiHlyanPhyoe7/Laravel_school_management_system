@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container ">
        <legend>Notification</legend>


        <table class="table table-hover mt-10">
            {{ $notification->links() }}
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Sender Name</th>
                <th scope="col">Message</th>
                <th scope="col">Send Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($notification as $item)
                <tr>
                    <th scope="row">{{ $item['notification_id'] }}</th>
                    <td>{{ $item['sender'] }}</td>
                    <td>{{ $item['message'] }}</td>
                    <td>{{ $item['send_date'] }}</td>
                  </tr>
                @endforeach
            </tbody>
          </table> 
      
    </div>

@endsection