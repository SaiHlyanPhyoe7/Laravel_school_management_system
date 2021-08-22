@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif


    <div class="container ">
        <table class="table table-hover mt-10">
            {{ $news->links() }}
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Request Course Title</th>
                <th scope="col">Request Course Deatails</th>
                <th scope="col">Request Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                <tr>
                    <th scope="row">{{ $item['course_request_id'] }}</th>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['course_request_title'] }}</td>
                    <td>{{ $item['course_request_details'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                
                  </tr>
                @endforeach
            </tbody>
          </table> 
      
    </div>


@endsection