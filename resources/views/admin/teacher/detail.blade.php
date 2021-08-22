@extends('layouts.adminDesign')

@section('content')

    @if (Session::has('authError'))
        <p style="color: red">{{ Session::get('authError') }}</p>
    @endif

 <div class="container mt-3">
     <div class="container">
            <div class="card">
                <div class="card-header">
                    <span>Teacher Information</span>
                    <span><a href="{{ route('lookTeacherList') }}"><button class="btn btn-sm btn-dark font-white float-right"></button></a></span>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->name">
                        </div>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->email">
                    </div>
                  </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->gender">
                </div>
              </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Phone Number One</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->phone_number_one">
                </div>
            </div>
            </div><div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Phone Number Two</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->phone_number_two>
                </div>
            </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Region</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->region">
                </div>
            </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Town</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->town">
                </div>
            </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="$teacher[0]->address">
                </div>
            </div>
            </div>
            </div>
            </div>
 </div>
@endsection