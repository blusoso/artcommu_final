@extends('layouts.app')

@section('content')
<div class="container register-login">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card register-card">
                <div class="card-body">
                  <h3>{{ __('Register') }}</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                              <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('User name') }}</label>

                              <div class="col-md-6">
                                  <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                  @if ($errors->has('username'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('username') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                  @if ($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                  @if ($errors->has('password'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>

                          <div class="form-group row">
                                <label for="display_name" class="col-md-4 col-form-label text-md-right">{{ __('Display Name') }}</label>

                                <div class="col-md-6">
                                    <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ old('display_name') }}" required autofocus>

                                    @if ($errors->has('display_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('Register') }}
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection
