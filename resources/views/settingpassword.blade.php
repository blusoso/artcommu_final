@extends('setting')

@section('setting-content')
<div id="page-setting-password">
  @if (Session::has('success'))
	 <div class="alert alert-success">{{ Session::get('success') }}</div>
  @endif
  @if (Session::has('error'))
  	 <div class="alert alert-danger">{{ Session::get('error') }}</div>
  @endif
  <div class="row col-12">
    <div class="col-md-4 text-md-right">
      <h5 class="mt-4 mb-3">Reset password</h5>
    </div>
    <div class="col-8"></div>
  </div>
  <form action="/settings/password" method="post">
    @csrf
    <div class="row col-12 my-2">
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
      <div class="col-md-6">
          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autofocus>
          @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
      </div>
    </div>
    <div class="row col-12 my-2">
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
      <div class="col-md-6">
          <input id="new_password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="new_password">
          @if ($errors->has('new_password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('new_password') }}</strong>
              </span>
          @endif
      </div>
    </div>
    <div class="row col-12 my-2">
      <label for="password_confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
      <div class="col-md-6">
          <input id="password_confirm" type="password" class="form-control" name="password_confirm">
      </div>
    </div>

    <button type="submit" id="save-password-btn" name="save-btn" class="btn btn-primary my-4">Save</button>
  </form>

</div>
@endsection
