@extends('layouts.app')

@section('content')
  @include('profile-header')
  <div id="page-following" class="page-follower">
    <div class="container-fluid collection">
      <div class="row mt-3">
        <div class="col-1"></div>
        <div class="col-10">
          @if($followings->count() == 0)
              <div class="no-content text-center font-weight-bold text-muted my-5">
                  <h5>No following other people now.</h5>
                  <h1>Let's following other people to see amazing work!</h1>
              </div>
          @else
              @foreach($followings as $following)
              <div class="card card-container mr-3 mb-3 float-left">
                <div class="card-body">
                  <a href="/profile/{{$following->findFollowing($following->following_id)->username}}">
                    <div class="avatar">
                      <div class="imageAvatar" style="background-image: url('/../storage/upload/{{$following->findFollowing($following->following_id)->avatar}}');"></div>
                    </div>
                  </a>
                  <div class="info-user mt-3">
                    <h5 class="font-weight-bold">{{$following->findFollowing($following->following_id)->display_name}}</h5>
                    <p class="biofollow">{{$following->findFollowing($following->following_id)->bio}}</p>
                    <a href="">{{$following->findFollowing($following->following_id)->bio_link}}</p></a><p>
                  </div>
                  @if($following->I_following())
                    <button class="following-btn following{{$following->id}} btn btn-primary" data-owner="{{Auth::user()->id}}" data-following="{{$following->following_id}}" data-isfollow="{{$following->is_follow}}" data-id="{{$following->id}}">Following</button>
                  @elseif(empty($following->I_following()) && $following->following_id != Auth::user()->id)
                    <button class="follow-btn following{{$following->id}} btn btn-primary" data-owner="{{Auth::user()->id}}" data-following="{{$following->following_id}}" data-isfollow="{{$following->is_follow}}" data-id="{{$following->id}}">Follow</button>
                  @endif
                </div>
              </div>
              @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
