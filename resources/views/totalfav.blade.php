@extends('layouts.app')

@section('content')
  @include('profile-header')
  <div id="totalfav-page" class="container-fluid collection">
    <div class="row mt-3">
      <div class="col-1"></div>
      <div class="col-10">
        @if($favorites->count() == 0)
            <div class="no-content text-center font-weight-bold text-muted my-5">
                <h5>No any favorite now.</h5>
                <h1>Let's favorite other post!</h1>
            </div>
        @else
            @foreach($favorites as $favorite)
              @if($favorite->post && $favorite->is_fav == 1)
                <div id="fav-{{$favorite->id}}" class="card m-1">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 pr-0">
                        <a href="/profile/{{$favorite->findUser($favorite->post->id ?? '')->username}}">
                          <div class="post-avatar">
                            <div class="postAvatar" style="background-image: url('/../storage/upload/{{$favorite->findUser($favorite->post->id ?? '')->avatar}}');"></div>
                          </div>
                        </a>
                      </div>
                      <div class="col-9 pl-0 pt-2">
                        <a href="/profile/{{$favorite->findUser($favorite->post->id ?? '')->username}}">{{$favorite->findUser($favorite->post->id ?? '')->display_name}}</a>
                      </div>
                    </div>
                    <div class="image-post my-3">
                      <div class="imagePost" id="imagePost-{{$favorite->post->id ?? ''}}" style="background-image: url('/../storage/uploadpost/{{$favorite->post->img ?? ''}}');" data-img="/../storage/uploadpost/{{ $favorite->post->img ?? '' }}"></div>
                    </div>
                    @if(!empty($favorite->post->description ?? ''))
                      <p class="card-text my-2 row col-12">{{$favorite->post->description ?? ''}}</p>
                    @else
                      <p class="card-text my-2 row col-12">&nbsp</p>
                    @endif
                    <div class="row">
                      <div class="col-4">
                        @if($user_id->id == Auth::user()->id)
                          <label class="heartimgfav heartimgfav{{$favorite->id}} @if($favorite->is_fav == 1) heartimg-active @endif" data-favid="{{$favorite->id}}" data-post_id="{{$favorite->post_id}}">❤</label>
                        @else
                          <label class="heartimgfav-otheruser @foreach($UserLikePosts as $UserLikePost) @if($UserLikePost->user_id == Auth::user()->id && $UserLikePost->post_id == $favorite->post->id && $UserLikePost->is_fav == 1) heartimg-active @endif @endforeach" data-post_id="{{$favorite->post_id}}" data-userid = "{{Auth::user()->id}}">❤</label>
                        @endif
                        <label>&nbsp&nbsp</label>
                        <label class="fav-counting{{$favorite->post->id ?? ''}}">{{$favorite->fav_count($favorite->post->id)}}</label>
                      </div>
                      <div class="col-8 save-to-collection">
                        <a href="#" class="saveToCollection-btn btn btn-primary" data-toggle="modal" data-target="#saveToCollectionModal" data-postid="{{$favorite->post_id}}">Save to Collection</a>
                      </div>
                    </div>
                    <!-- {{$favorite->is_fav}} -->
                    <!-- {{$favorite->findUser($favorite->post->id ?? '')->avatar}} -->
                  </div>
                </div>
              @endif
            @endforeach
          @endif
      </div>
    </div>
  </div>

  @include('enlargeimg')
  @include('savetocollectionmodal')

@endsection
