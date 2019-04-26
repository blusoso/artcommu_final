@extends('layouts.app')

@section('create-collection')
<div class="row">
  <div class="col-11 mt-1">
    <a href="/collection/{{$username}}/following" class="btn btn-primary following-coll-btn px-4 pull-right" style="color: #fff;background-color: #6665f5;">Following Collection</a>
  </div>
  <div class="col-1"></div>
</div>
@endsection

@section('content')
  @include('profile-header')
  <div id="followingcollection-page">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10 py-3">
        @if($user_like_collections->count() == 0)
            <div class="no-content text-center font-weight-bold text-muted my-5">
              <h5>No any following collection now.</h5>
              <h1>Let's following collection of others!</h1>
            </div>
        @else
            <div class="row">
              @foreach($user_like_collections as $user_like_collection)
                @if($user_like_collection->collection)
                  <div id="favcollection{{$user_like_collection->collection_id}}" class="col-xl-4 col-lg-6 col-md-12 mb-3">
<<<<<<< HEAD
                    <a href="/collection/{{$user_like_collection->collection->user->username}}/{{$user_like_collection->collection->title}}-{{$user_like_collection->collection->id}}">
=======
                    <a href="/collection/{{$username}}/{{$user_like_collection->collection->title}}-{{$user_like_collection->collection->id}}">
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
                      <div class="card card-container">
                        <div class="row">
                          <div class="col-2">
                            <div class="collection-avatar mt-3 mx-3">
                              <a href="/profile/{{$user_like_collection->get_owner_collection($user_like_collection->collection->user_id)->username}}"><div class="collectionAvatar" style="background-image: url('/../storage/upload/{{$user_like_collection->get_owner_collection($user_like_collection->collection->user_id)->avatar}}');"></div></a>
                            </div>
                          </div>
                          <div class="col-10 px-4" style="padding-top: 7%;">
<<<<<<< HEAD
                            <a class="username" href="/profile/{{$user_like_collection->collection->user->username}}">{{$user_like_collection->get_owner_collection($user_like_collection->collection->user_id)->username}}</a>
=======
                            <a class="username" href="/profile/{{$user_like_collection->get_owner_collection($user_like_collection->collection->user_id)->username}}">{{$user_like_collection->get_owner_collection($user_like_collection->collection->user_id)->username}}</a>
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
                          </div>
                        </div>
                        <div  class="card preview-image ml-4 mt-3" style="background-image: url('/../images/collection/cover.png');background-size: cover;background-repeat: no-repeat;background-position: center;">
                          <div class="card-body p-0">
                            <?php $count = 0; ?>
                            @foreach($user_like_collection->get_post_has_collection($user_like_collection->collection_id) as $post)
                              <?php if($count == 4) break; ?>
                                <div class="img-box hasimage-{{$user_like_collection->get_post_count($user_like_collection->collection_id)}}">
                                    <div class="previewImage" style="background-image: url('/../storage/uploadpost/{{$user_like_collection->get_post($post->post_id)->img}}');"></div>
                                </div>
                              <?php $count++; ?>
                            @endforeach
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12">
<<<<<<< HEAD
                              <a href="/collection/{{$user_like_collection->collection->user->username}}/{{$user_like_collection->collection->title}}-{{$user_like_collection->collection->id}}"><h4>{{$user_like_collection->collection->title}}</h4></a>
=======
                              <a href="/collection/{{$username}}/{{$user_like_collection->collection->title}}-{{$user_like_collection->collection->id}}"><h4>{{$user_like_collection->collection->title}}</h4></a>
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-6">
                              <div class="row">
                                <div class="col-4 pr-0">
                                  @if($user_id->id == Auth::user()->id)
                                    <label class="heart @if($user_like_collection->is_fav == 1 && $user_id->id == Auth::user()->id) heart-active @endif @foreach($UserLikeCollections as $UserLikeCollection) @if($UserLikeCollection->collection_id == $user_like_collection->collection_id && $UserLikeCollection->user_id == Auth::user()->id) heart-active @endif @endforeach" data-userid="{{Auth::user()->id}}" data-collectionid="{{$user_like_collection->collection_id}}" data-id="{{$user_like_collection->id}}">
                                    </label>
                                  @else
                                    <label class="heart-otheruser @foreach($UserLikeCollections as $UserLikeCollection) @if($UserLikeCollection->collection_id == $user_like_collection->collection_id && $UserLikeCollection->user_id == Auth::user()->id && $UserLikeCollection->is_fav == 1) heart-active @endif @endforeach" data-collectionid="{{$user_like_collection->collection->id}}" data-userid="{{Auth::user()->id}}">
                                    </label>
                                  @endif
                                  <label class="fav-counting{{$user_like_collection->collection_id}} ml-2">{{$user_like_collection->collection->favorite_count}}</label>
                                </div>
                                <div class="col-8">
                                  <img src="{{asset('images/icons/album.png')}}" class="m-2 float-left" alt="album">
                                  <label class="fav-image-count ml-2">{{$user_like_collection->get_post_count($user_like_collection->collection_id)}}</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-6"></div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endif
              @endforeach
            </div>
        @endif
      </div>
    </div>
  </div>
@endsection
