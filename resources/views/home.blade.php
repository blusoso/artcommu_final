@extends('layouts.app')

@section('content')
<div id="page-home">
  <div class="container" style="min-height: 896px;">
    <div class="row">
      <div class="col-lg-3 col-sm-12 pr-2 py-2">
        <div class="card bio-card">
          <div class="card-body px-5">
            <div class="row">
              <div class="col-lg-12 col-sm-6">
                <a href="/profile/{{Auth::user()->username}}">
                  <div class="avatar">
                    <div class="imageAvatar" style="background-image: url('../storage/upload/{{ Auth::user()->avatar }}');"></div>
                  </div>
                </a>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-lg-12 col-sm-6">
                <h5 class="bio-displayname">{{ Auth::user()->display_name }}</h5>
              </div>
            </div>
            <p class="bio-content mt-2">{{ Auth::user()->bio }}</p>
            <a href="{{ Auth::user()->bio_link }}">{{ Auth::user()->bio_link }}</a>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-sm-12 py-2 pl-0">
        @foreach($users as $user)
          @if($user->id == Auth::user()->id)
            @include('formpost')
          @endif
        @endforeach
        <div class="card topic-card">
          <div class="card-body">
            <h6>POST</h6>
          </div>
        </div>
          <div class="card default-card">
            <div class="card-body pt-0">
              @if($is_follows_count > 0)
                  @foreach($posts as $post)
                      @foreach($is_follows as $is_follow)
                          @if($post->user_id == $is_follow->following_id)
                              @include('postcontent')
                          @endif
                      @endforeach
                  @endforeach
              @else
                  <div class="no-content text-center font-weight-bold text-muted my-5">
                      <h5>No any post now.</h5>
                      <h1>Let's following more users!</h1>
                  </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('footer')
  </div>
@include('savetocollectionmodal')
@include('createcollectionmodal')
@endsection
