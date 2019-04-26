@extends('layouts.app')

@section('content')
<div id="page-setting">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-sm-12 pr-2 py-2">
          <div class="card bio-card">
            <div class="card-body px-5">
              <div class="row">
                <div class="col-12">
                  <form method="post" action="{{URL::to('/settings/account/updateimage')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="avatar">
                      <div class="avatar-edit">
                          <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                          <input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg" />
                          <label for="imageUpload"></label>
                      </div>
                        <div class="imageAvatar2" style="background-image: url('../storage/upload/{{ Auth::user()->avatar }}');"></div>
                      <input type="hidden" name="avatar" id="avatar" value="{{ Auth::user()->avatar }}">
                    </div>
                    <button type="submit" name="save-btn" class="save-image-btn btn btn-primary ml-5 mt-2 hidden" data-userid="{{ Auth::user()->id }}">Save</button>
                  </form>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12">
                  <h5 class="bio-displayname">{{ Auth::user()->display_name }}</h5>
                </div>
              </div>
              <p class="bio-content mt-2">{{ Auth::user()->bio }}</p>
              <a href="{{ Auth::user()->bio_link }}">{{ Auth::user()->bio_link }}</a>
            </div>
          </div>
          <a href="/settings/account" class="setting-menu">
              <div class="card card-menu mt-3 @if(Request::is('settings/account')) menu-card-active @endif">
                <div class="card-body px-5 py-1 mt-2">
                  <div class="row">
                    <div class="col-12">
                      <h6 class="@if(Request::is('settings/account')) menu-active @endif">Account</h6>
                    </div>
                  </div>
                </div>
              </div>
          </a>
          <a href="/settings/password" class="setting-menu">
            <div class="card card-menu @if(Request::is('settings/password')) menu-card-active @endif">
              <div class="card-body px-5 py-1 mt-2">
                <div class="row">
                  <div class="col-12">
                    <h6 class="@if(Request::is('settings/password')) menu-active @endif">Reset Password</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-9 col-sm-12 py-2 pl-0">
          <div class="card topic-card">
            <div class="card-body">
              <h5>Settings</h5>
            </div>
          </div>
          <div class="card default-card">
            <div class="card-body">
              @if (Request::is('settings/account'))
                @yield('settingaccount-content')
              @elseif (Request::is('settings/password'))
                @yield('setting-content')
              @endif
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@include('footer')
@endsection
