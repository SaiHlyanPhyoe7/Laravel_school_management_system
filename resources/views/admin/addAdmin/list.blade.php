@extends('layouts.adminDesign')

@section('content')

    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif
    
    <div class="container mt-2">

        @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
          {{ Session::get('deleteSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        @endif
     

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div></div>
                <div><a href="{{ route('addAdmin') }}"><button class="btn-sm btn-dark font-light float-right ">Back</button></a></div>
            </div>
            <div class="card-body">
                <table class="table table-hover mt-10">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Region</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $item)
                        <tr>
                            <th scope="row">{{ $item['id'] }}</th>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['phone_number_one'] }}</td>
                            <td>{{ $item['region'] }}</td>
                            <td></td>
                            <td>
                                <a href="{{ route('deleteAdminAccount',$item['id']) }}"> <button  class="btn btn-sm btn-danger font-white">Delete</button></a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div> 
    </div>
@endsection