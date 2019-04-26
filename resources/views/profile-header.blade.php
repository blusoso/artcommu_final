<div id="profileheader-page" class="profile-background">
  <div class="container header pt-5 pb-5" id="profile-header">
    <div class="row py-4">
      <div class="col-md-9 col-sm-12">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-8">
                @foreach ($users as $user)
                  @if($user->username == $username)
                    <h1>{{ $user->display_name }}</h1>
                    @if(Auth::user()->id != $user->id)
                      <button id="follow-btn" type="button" name="follow" class="follow-btn @foreach ($follows as $follow) @if(Auth::user()->id == $follow->owner_id && $user->id == $follow->following_id) @if($follow->is_follow == 1) unfollow-active @endif @endif @endforeach btn btn-primary active-header mt-1 ml-4"
                        data-owner = "{{Auth::user()->id}}" data-following="{{$user->id}}" data-username="{{$user->username}}"><span>Follow<span></button>
                    @endif
              </div>
            </div>
            <div class="total-info row pt-2">
              <a href="/profile/{{$user->username}}/following" class="total col-4 pt-2">
                <h6>Following</h6>
                <h2><span class="following_count{{Auth::user()->id}}">{{$user_following_count}}</span></h2>
              </a>
              <a href="/profile/{{$user->username}}/follower" class="total col-4 pt-2">
                <h6>Follower</h6>
                <h2><span class="follower_count{{Auth::user()->id}}">{{$user_follower_count}}</span></h2>
              </a>
              <a href="/favorite/{{$user->username}}" class="total col-4 pt-2">
                <h6>Favorite</h6>
                <h2>{{$total_fav}}</h2>
              </a>
            </div>
            <div class="row pt-5">
              <div class="col-xl-5 col-md-9 col-sm-12">
                <div class="row">
                  <div class="col-md-4 col-4">
                    <a href="/profile/{{$user->username}}" class="btn btn-primary @if(Request::is('profile/*')) active-header @endif">Profile</a>
                  </div>
                  <div class="col-md-4 col-4 p-0">
                    <a href="/collection/{{$user->username}}" class="btn btn-primary @if(Request::is('collection/*')) active-header @endif">Collection</a>
                  </div>
                  <div class="col-md-4 col-4">
                    <a href="/favorite/{{$user->username}}" class="btn btn-primary @if(Request::is('favorite/*')) active-header @endif">Favorite</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-7 col-md-3"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-12">
        <div class="row">
          <div class="col-10">
            <a href="/profile/{{$user->username}}">
              <div class="avatar">
                <div class="imageAvatar" style="background-image: url('/../storage/upload/{{ $user->avatar }}');"></div>
              </div>
            </a>
              @yield('sorting-collection')
          </div>
          <div class="col-2"></div>
        </div>
      </div>
        @endif
      @endforeach
    </div>
    @yield('create-collection')
  </div>
</div>
