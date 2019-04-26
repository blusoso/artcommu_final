@extends('layouts.app')

@section('content')

  <div id="rand_follow_page" class="container-fluid mt-5">
      <div class="card card-body">
        <div class="text-center font-weight-bold text-muted my-2">
          <h1>Start Follow!</h1>
          <h5>Select at least 3 people to follow </h5>
        </div>
        @foreach($rand_users as $rand_user)
        <div class="rand_users row mb-3">
          <div class="col-10">
            <div class="row">
              <div class="col-2">
                <div class="avatar float-left ml-3">
                  <a href="/profile/{{$rand_user->username}}"><div class="imageAvatar" style="background-image: url('../storage/upload/{{ $rand_user->avatar }}');"></div></a>
                </div>
              </div>
              <div class="col-10">
                <a href="/profile/{{$rand_user->username}}">{{ $rand_user->display_name }}</a>
              </div>
            </div>
          </div>
          <div class="col-2">
              <button id="follow-btn{{$rand_user->id}}" type="button" name="follow" class="follow-btn @foreach($follows as $follow) @if($follow->following_id == $rand_user->id && $follow->is_follow == 1) unfollow-active @endif @endforeach btn btn-primary" data-owner = "{{Auth::user()->id}}" data-following = "{{$rand_user->id}}" data-username = "{{$rand_user->username}}"><span>Follow<span></button>
          </div>
        </div>
        @endforeach
        <a href="/startfollow" class="font-weight-bold text-center text-success">↻ Random Again</a>
        <a href="/home" class="font-weight-bold text-center text-primary mt-3 border border-primary p-2 mx-3">Continue →</a>
      </div>
  </div>

@endsection
