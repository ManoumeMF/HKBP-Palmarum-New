@if ($message = Session::get('success'))
  <script>
    const notySucces = new Noty({
    theme: ' bg-success',
    text: '{{ session('success') }}',
    type: 'success',
    modal: true,
    timeout: 1500,
    closeWith: ['button']
    });

    notySucces.show();
  </script>
@endif

@if ($message = Session::get('error'))
  <script>
    const notyError = new Noty({
    theme: ' bg-error',
    text: '{{ session('error') }}',
    type: "error",
    modal: true,
    timeout: 1500,
    closeWith: ['button']
    });
    notyError.show();
  </script>
@endif

@if ($message = Session::get('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($message = Session::get('info'))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($errors->any())
  <!--<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please check the form below for errors</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>-->
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Whoops!</strong> Ada masalah tengan beberapa data inputan Anda!<br><br>
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif