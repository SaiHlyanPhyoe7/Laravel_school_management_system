
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
  {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" >&times;</span>
    </button>
</div>
@endif    

@if (Session::has('notSameBoth'))
<div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
  {{ Session::get('notSameBoth') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" >&times;</span>
    </button>
</div>
@endif

@if (Session::has('errorLength'))
<div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
  {{ Session::get('errorLength') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" >&times;</span>
    </button>
</div>
@endif

@if (Session::has('noMatch'))
<div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
  {{ Session::get('noMatch') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" >&times;</span>
    </button>
</div>
@endif