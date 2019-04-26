<div id="collection{{$collection->id}}" class="col-xl-4 col-lg-6 col-md-12 mb-3">
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
                <label class="fav-counting{{$collection->id}} ml-2">{{$collection->follow_collection_count($collection->id)}}</label>
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
