@extends('layouts.adminDesign')

@section('content')

    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        <a href="{{ route('downloadStudentCsv') }}"><button class="btn btn-sm btn-success mb-4">Download CSV</button></a>
        <table class="table table-hover mt-10">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Phone Number</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($student as $item)
                <tr>
                    <th scope="row">{{ $item['id'] }}</th>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['gender'] }}</td>
                    <td>{{ $item['phone_number_one'] }}</td>
                    <td>
                        <a href=""> <button  class="btn btn-sm btn-secondary">More Details</button></a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table> 
     </div>
@endsection