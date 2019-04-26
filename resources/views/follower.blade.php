@extends('layouts.app')

@section('content')
  @include('profile-header')
  <div id="page-follower" class="page-follower">
    <div class="container-fluid collection">
      <div class="row mt-3">
        <div class="col-1"></div>
        <div class="col-10">
          @if($followers->count() == 0)
              <div class="no-content text-center font-weight-bold text-muted my-5">
                  <h5>No any follower now.</h5>
                  <h1>Let's share your grate work<br />for make other people impress you!</h1>
              </div>
          @else
              @foreach($followers as $follower)
                <div class="card card-container mr-3 mb-3 float-left">
                  <div class="card-body">
                    <a href="/profile/{{$follower->user->username}}">
                      <div class="avatar">
                        <div class="imageAvatar" style="background-image: url('/../storage/upload/{{$follower->user->avatar}}');"></div>
                      </div>
                    </a>
                    <div class="info-user mt-3">
                      <h5 class="font-weight-bold">{{$follower->user->display_name}}</h5>
                      <p class="biofollow">{{$follower->user->bio}}</p>
                      <a href="">{{$follower->user->bio_link}}</p></a><p>
                      @if($follower->followingpeople($follower->owner_id))
                        <button class="following-btn following{{$follower->id}} btn btn-primary" data-owner="{{Auth::user()->id}}" data-following="{{$follower->owner_id}}" data-isfollow="{{$follower->is_follow}}" data-id="{{$follower->id}}">Following</button>
                      @elseif(empty($follower->followingpeople($follower->owner_id)))
                        <button class="follow-btn following{{$follower->id}} btn btn-primary" data-owner="{{Auth::user()->id}}" data-following="{{$follower->owner_id}}" data-isfollow="{{$follower->is_follow}}" data-id="{{$follower->id}}">Follow</button>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
        </div>
      </div>
    </div>
  </div>
@endsection
