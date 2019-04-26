@extends('layouts.app')

@section('sorting-collection')
<div class="row pt-5">
  <div class="col-12">
    <select id="filter" class="btn btn-primary" style="border-radius: 4px">
      @foreach ($users as $user)
        @foreach ($sorting_collections as $sorting_collection)
          @if($user->username == $username)
          <option value="sorting-{{$sorting_collection->id}}" data-sortingid="{{$sorting_collection->id}}" data-userid="{{$user->id}}" data-username="{{$user->username}}">{{$sorting_collection->sorting_name}}</option>
          @endif
        @endforeach
      @endforeach
    </select>
  </div>
</div>
@endsection

@section('create-collection')
<div class="row">
  <div class="col-11 mt-1">
    <a href="/collection/{{$username}}/following" class="btn btn-primary following-coll-btn px-4 pull-right">Following Collection</a>
  </div>
  <div class="col-1">
    <button class="btn btn-primary plus-symbol mb-3" data-toggle="modal" data-target="#createCollectionModal" >+</button>
  </div>
</div>
@endsection

@section('content')
<div id="page-collection">
  @include('profile-header')
  <div class="container-fluid collection">
    <div class="row collection-list-content">
      <div class="col-1"></div>
      <div class="col-10 py-3">
          @if($collections->count() == 0)
              <div class="no-content text-center font-weight-bold text-muted my-5">
                <h5>No any collection now.</h5>
                <h1>Let's create your first collection!</h1>
              </div>
          @else
          <div id="collection-list" class="row">
              @foreach($collections as $collection)
<<<<<<< HEAD
                  @if($username != Auth::user()->username && $collection->is_private == 0)
                      @include('collection-list')
                  @elseif($username == Auth::user()->username)
                      @include('collection-list')
                  @endif
=======
                @foreach($users as $user)
                  @if($user->username == $username)
                    @if($collection->user_id == $user->id)
                      @if(Auth::user()->username != $username)
                        @if($collection->is_private == 0)
                          <div id="@foreach($collections as $collection) collection{{$collection->id}} @endforeach" class="col-xl-4 col-lg-6 col-md-12 mb-3">
                            <a href="/collection/{{$username}}/{{$collection->title}}-{{$collection->id}}">
                              <div class="card card-container collection-{{$collection->id}}">
                                <div  class="card preview-image ml-4 mt-4 @foreach($post_has_collections as $post_has_collection) @if(!$post_has_collection->find_image($collection->id)) default-priview-image @break @endif @endforeach" style="background-image: url('../images/collection/cover.png');">
                                  <div class="card-body p-0">
                                      <?php $count = 0; ?>
                                      @foreach($post_has_collections as $post_has_collection)
                                        @if($post_has_collection->collection_id == $collection->id)
                                          @foreach($posts as $post)
                                            @if($post_has_collection->post_id == $post->id)
                                                <?php if($count == 4) break; ?>
                                                  <div class="img-box hasimage-{{$collection->get_post_image()}}">
                                                      <div class="previewImage" style="background-image: url('../storage/uploadpost/{{ $post->img }}');"></div>
                                                  </div>
                                                <?php $count++; ?>
                                              @endif
                                            @endforeach
                                          @endif
                                        @endforeach
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-8">
                                      <a href="/collection/{{$username}}/{{$collection->title}}-{{$collection->id}}"><h4>{{$collection->title}}</h4></a>
                                    </div>
                                    <div class="col-4">
                                      <div class="row">
                                        <div class="col-6">
                                          @if($collection->is_private==1)
                                            <img src="{{asset('images/icons/padlock.png')}}" alt="padlock">
                                          @endif
                                        </div>
                                      </div>
                                      {{ csrf_field() }}
                                      <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-6">
                                      <div class="row">
                                        <div class="col-4 pr-0">
                                          <label class="heart @foreach($user_like_collections as $user_like_collection) @if($user_like_collection->user_id == Auth::user()->id) @if($user_like_collection->collection_id == $collection->id) @if($user_like_collection->is_fav == 1) heart-active @endif @endif @endif @endforeach" data-collectionid="{{$collection->id}}" data-userid="{{Auth::user()->id}}" >
                                          </label>
                                          <label class="fav-counting{{$collection->id}} ml-2">{{$collection->favorite_count}}</label>
                                        </div>
                                        <div class="col-8">
                                          <img src="{{asset('images/icons/album.png')}}" class="m-2 float-left" alt="album">
                                          <label class="fav-image-count ml-2">{{$collection->get_post_image()}}</label>
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
                      @else
                      <div class="col-xl-4 col-lg-6 col-md-12 mb-3">
                        <a href="/collection/{{$username}}/{{$collection->title}}-{{$collection->id}}">
                          <div class="card card-container collection-{{$collection->id}}">
                            <div  class="card preview-image ml-4 mt-4 @foreach($post_has_collections as $post_has_collection) @if(!$post_has_collection->find_image($collection->id)) default-priview-image @break @endif @endforeach" style="background-image: url('../images/collection/cover.png');">
                              <div class="card-body p-0">
                                  <?php $count = 0; ?>
                                  @foreach($post_has_collections as $post_has_collection)
                                    @if($post_has_collection->collection_id == $collection->id)
                                      @foreach($posts as $post)
                                        @if($post_has_collection->post_id == $post->id)
                                            <?php if($count == 4) break; ?>
                                              <div class="img-box hasimage-{{$collection->get_post_image()}}">
                                                  <div class="previewImage" style="background-image: url('../storage/uploadpost/{{ $post->img }}');"></div>
                                              </div>
                                            <?php $count++; ?>
                                          @endif
                                        @endforeach
                                      @endif
                                    @endforeach
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-8">
                                  <a href="/collection/{{$username}}/{{$collection->title}}-{{$collection->id}}"><h4>{{$collection->title}}</h4></a>
                                </div>
                                <div class="col-4">
                                  <div class="row">
                                    <div class="col-6">
                                      @if($collection->is_private==1)
                                        <img src="{{asset('images/icons/padlock.png')}}" alt="padlock">
                                      @endif
                                    </div>
                                    <div class="col-6">
                                      <button id="edit-btn" class="btn btn-primary edit_button" data-toggle="modal" data-target="#editCollectionModal" data-userid="{{Auth::user()->id}}" data-collectid="{{$collection->id}}" data-title="{{$collection->title}}" data-description="{{$collection->description}}" data-isprivate="{{$collection->is_private}}">Edit</button>
                                    </div>
                                  </div>
                                  {{ csrf_field() }}
                                  <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <div class="row">
                                    <div class="col-4 pr-0">
                                      <label class="heart" style="cursor: context-menu;"></label>
                                      <label class="fav-counting ml-2">{{$collection->favorite_count}}</label>
                                    </div>
                                    <div class="col-8">
                                      <img src="{{asset('images/icons/album.png')}}" class="m-2 float-left" alt="album">
                                      <label class="fav-image-count ml-2">{{$collection->get_post_image()}}</label>
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
                    @endif
                  @endif
                @endforeach
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
              @endforeach
          </div>
          @endif
      </div>
      <div class="col-1"></div>
    </div>
  </div>
  @include('editcollectionmodal')
  @include('createcollectionmodal')
</div>
@endsection
