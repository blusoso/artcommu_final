@extends('layouts.app')

@section('content')
<div id="page-favimage">
  <div class="profile-background">
    <div class="container header pt-5 pb-5" id="profile-header">
      <div class="row py-4">
        <div class="col-md-9 col-sm-12">
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-8">
                  @csrf
                  @foreach ($users as $user)
                    @if($user->username == $username)
                    @foreach ($collections as $collection)
                      @if($collection->id == $id)
                      <h6>Collection: </h6>
                      <h1 class="collection-title">{{ $collection->title }}&nbsp</h1>
                      @if($collection->is_private==1)
                        <img src="{{asset('images/icons/padlock.png')}}" alt="padlock">
                      @endif
                      @if($username == Auth::user()->username)
                          <button class="btn btn-primary edit_button mt-1 ml-3" data-toggle="modal" data-target="#editCollectionModal" data-collectid="{{$id}}" data-title="{{$title}}" data-description="{{$collection->description}}" data-isprivate="{{$collection->is_private}}">Edit</button>
                      @endif
                </div>
              </div>
                  <h6>{{$collection->description}}</h6>
                  <p class="fav_count">{{$collection->follow_collection_count($collection->id)}} Follower</p>
                    @endif
                  @endforeach
              <div class="row pt-5">
                <div class="col-xl-5 col-md-9 col-sm-12">
                  <div class="row">
                    <div class="col-md-4 col-4">
                      <a href="/profile/{{$user->username}}" class="btn btn-primary @if(Request::is('profile')) active-header @endif">Profile</a>
                    </div>
                    <div class="col-md-4 col-4 p-0">
                      <a href="/collection/{{$user->username}}" class="btn btn-primary @if(Request::is('collection')) active-header @endif">Collection</a>
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
                  <div class="imageAvatar" style="background-image: url('/../storage/upload/{{$user->avatar}}');"></div>
                </div>
              </a>
                @yield('sorting-collection')
            </div>
            <div class="col-2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10 py-3">
      <div id="fav-postincollection">
        @foreach($post_has_collections as $post_has_collection)
          <div class="card m-1">
            <div class="card-body">
              <div class="row">
                <div class="col-3 pr-0">
                  <a href="/profile/{{$post_has_collection->find_user($post_has_collection->post->id) ?? ''->username}}">
                    <div class="post-avatar">
                      <div class="postAvatar" style="background-image: url('/../storage/upload/{{$post_has_collection->find_user($post_has_collection->post->id)->avatar}}');"></div>
                    </div>
                  </a>
                </div>
                <div class="col-9 pl-0 pt-2">
                  <a href="/profile/{{$post_has_collection->find_user($post_has_collection->post->id)->username}}">{{$post_has_collection->find_user($post_has_collection->post->id)->display_name}}</a>
                  @if($user->id ==  Auth::user()->id)
                    <span class="delete-favimg pull-right" data-posthascollectionid = "{{$post_has_collection->id}}">&times;</span>
                  @endif
                </div>
              </div>
              <div class="image-post my-3">
                <div class="imagePost" id="imagePost-{{$post_has_collection->post->id}}" style="background-image: url('/../storage/uploadpost/{{$post_has_collection->post->img}}');" data-img="/../storage/uploadpost/{{ $post_has_collection->post->img }}"></div>
              </div>
            @if(!empty($post_has_collection->post->description))
              <p class="card-text my-2 row col-12">{{$post_has_collection->post->description}}</p>
            @else
              <p class="card-text my-2 row col-12">&nbsp</p>
            @endif
            <div class="row">
              <div class="col-4">
                <label class="heartimg @if($post_has_collection->favimg($post_has_collection->post->id)->is_fav ?? '' == 1) heartimg-active @endif" data-userid="{{$user->id}}" data-postid="{{$post_has_collection->post->id}}">❤</label>
                <label>&nbsp&nbsp</label>
                <label class="fav-counting{{$post_has_collection->post->id}}">{{$post_has_collection->post->fav_count($post_has_collection->post->id)}}</label>
              </div>
              <div class="col-8 save-to-collection">
                <a href="#" class="saveToCollection-btn btn btn-primary" data-toggle="modal" data-target="#saveToCollectionModal2" data-postid="{{$post_has_collection->post->id}}">Save to Collection</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      @endforeach
      </div>
    </div>
  </div>

</div>
@include('enlargeimg')
@include('editcollectionmodal')
<!-- modal -->
<div class="modal fade" id="saveToCollectionModal2" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="saveModalLabel">Save to Collection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success hidden alertsave" role="alert">
          Save Success
        </div>
        <form>
          <div class="form-group w-50">
            <input type="hidden" id="post_id" value="" />
            <select id="select-collection" class="form-control @foreach($collections as $collection) @if($collection->find_collection(Auth::user()->id) > 0) have-select @break @else hide-select @break @endif @endforeach">
              <option value="">--- Choose collection ---</option>
              @foreach($collections as $collection)
                @if($collection->user_id == Auth::user()->id)
                  <option value="collection-{{ $collection->id }}" data-collectid="{{$collection->id}}">{{ $collection->title }}</option>
                @endif
              @endforeach
              </select>
          </div>
          <div class="row">
            <div class="col-10">
              <a href="#createCollectionModal" id="newcollection-btn" data-toggle="modal" data-target="#createCollectionModal">+ New Collection</a>
            </div>
            <div class="col-2 p-0">
              <input id="save-btn-tocollection-favimage" type="button" class="btn btn-primary" value="Save">
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->

@endsection
