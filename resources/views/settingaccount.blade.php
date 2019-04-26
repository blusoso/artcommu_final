@extends('setting')

@section('settingaccount-content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row col-12">
      <div class="col-md-4 text-md-right">
        <h5 class="mt-4 mb-3">Account</h5>
      </div>
      <div class="col-8"></div>
    </div>
    <form method="post" action="{{URL::to('/settings/account/update')}}" enctype="multipart/form-data">
       @csrf
      <div class="row col-12 my-3">
        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
        <div class="col-md-6">
            <input type="hidden" id="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ Auth::user()->username }}">
            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
      </div>
      <div class="row col-12 my-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}">
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
      </div>
      <div class="row col-12 my-3">
        <label for="display_name" class="col-md-4 col-form-label text-md-right">{{ __('Display name') }}</label>
        <div class="col-md-6">
            <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ Auth::user()->display_name }}">
            @if ($errors->has('display_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
      </div>
      <div class="row col-12 my-3">
        <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>
        <div class="col-md-6">
            <textarea class="form-control" name="bio" id="bio" rows="5">{{ Auth::user()->bio }}</textarea>
        </div>
      </div>
      <div class="row col-12 my-3">
        <label for="bio_link" class="col-md-4 col-form-label text-md-right">{{ __('Bio Link') }}</label>
        <div class="col-md-6">
            <input type="text" class="form-control{{ $errors->has('bio_link') ? ' is-invalid' : '' }}" name="bio_link" id="bio_link" value="{{ Auth::user()->bio_link }}"/></input>
            @if ($errors->has('bio_link'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bio_link') }}</strong>
                </span>
            @endif
            <p class="mt-2 ex-bio">Example: https://example.com, www.example.com</p>
        </div>
      </div>
      <div class="row col-12 my-3">
        <div class="col-md-4 text-md-right">
          <h5 class="mt-4 mb-3">Profile image</h5>
        </div>
        <div class="col-8"></div>
      </div>
      <div class="row col-12 my-3">
        <div class="avatar-upload">
          <div class="avatar-edit">
              <input type='file' id="imageUpload-edit" name="imageUpload-edit" accept=".png, .jpg, .jpeg" />
              <label for="imageUpload-edit"></label>
          </div>
          <div class="avatar-preview">
              <div id="imagePreview" class="imageAvatar2"  style="background-image: url('../storage/upload/{{ Auth::user()->avatar }}');"></div>
            <input type="hidden" name="avatar" id="avatar" value="{{ Auth::user()->avatar }}">
          </div>
        </div>
      </div>
      <button type="submit" name="save-btn" class="save-account-btn btn btn-primary mt-4 mb-3">Save</button>
    </form>
@endsection
