<div id="postcontent" class="py-3 postcontent{{$post->id}}">
  <div class="row pr-3">
    <div class="col-md-2 col-2 pr-0">
      <div class="avatar-post ml-3">
        <a href="/profile/{{$user->username}}"><div class="imageAvatar-post" style="background-image: url('../storage/upload/{{ $user->avatar }}');"></div></a>
      </div>
    </div>
    <div class="col-md-10 col-10 pl-0">
      <div class="post card" style="border:1px solid rgba(0, 0, 0, 0.05);">
        <div class="card-body py-2">
          <div class="row">
            <div class="col-6">
              <div class="user-post">
                <a href="/profile/{{$user->username}}">{{ $user->display_name }}</a>
              </div>
            </div>
            <div class="col-6 time-post">
              {{ $post->created_at->format('H:i:s | d-m-Y') }}
              @if($post->user_id ==  Auth::user()->id)
                <span class="delete-post pull-right" data-postid = "{{$post->id}}">&nbsp&nbsp&nbsp&nbsp&times;</span>
              @endif
            </div>
          </div>
          @if(!empty($post->img))
            <div class="row">
              <div class="image-post my-3 col-12">
                <div class="imagePost" id="imagePost-{{$post->id}}" style="background-image: url('../storage/uploadpost/{{ $post->img }}');" data-img="../storage/uploadpost/{{ $post->img }}"></div>
              </div>
            </div>
          @endif
          @include('enlargeimg')
          <p class="card-text my-3">{{ $post->description }}</p>
          <div class="row">
            <div class="col-md-8 col-4">
              <div class="row">
                <div class="col-md-2 pr-0">
                  <label class="heart-post @foreach($user_like_posts as $user_like_post) @if($user_like_post->user_id == Auth::user()->id) @if($user_like_post->post_id == $post->id) @if($user_like_post->is_fav == 1) heart-post-active @endif @endif @endif @endforeach" data-postid="{{$post->id}}" data-userid="{{Auth::user()->id}}" >
                    ❤</label>
                  <label>&nbsp&nbsp</label>
                  @if($post->fav_count($post->id) != 0)
                    <label class="fav-counting{{$post->id}}">{{$post->fav_count($post->id)}}</label>
                  @endif
                </div>
                <div class="col-md-6 pt-2">
                  <img class="comment float-left" src="{{asset('images/icons/comment.png')}}" alt="comment" style="height: 19px;" data-postid="{{$post->id}}">
                  @if($post->comment_count($post->id) != 0)
                    <p class="comment-counting pt-1">&nbsp&nbsp {{$post->comment_count($post->id)}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-4 col-8 save-to-collection">
              <a href="#" class="saveToCollection-btn btn btn-primary pull-right" data-toggle="modal" data-target="#saveToCollectionModal" data-postid="{{$post->id}}">Save to Collection</a>
            </div>
          </div>
        </div>
      </div>
      <!-- comment part -->
      <div id="toggle-comment-{{$post->id}}" style="display: none;">
        <div class="card" id="commentContent">
          <div class="comment-content-card card-body">
            @foreach($comments as $comment)
              @if($comment->post_id == $post->id)
              <div class="row each-comment each-comment{{$comment->id}} py-1">
                <div class="col-2">
                  <div class="avatar-comment">
                    <a href="/profile/{{$comment->user->username}}"><div class="imageAvatar-comment" style="background-image: url('../storage/upload/{{ $comment->user->avatar }}');"></div></a>
                  </div>
                </div>
                <div class="col-10">
                  <a href="/profile/{{$comment->user->username}}">{{ $comment->user->display_name }}</a>
                  @if($comment->user_id ==  Auth::user()->id)
                    <span class="delete-comment pull-right" data-commentid="{{$comment->id}}" data-postid = "{{$comment->post_id}}">&times;</span>
                  @endif
                  <span class="time-comment pull-right mr-3 mt-1">{{ $comment->created_at->format('H:i:s | d-m-Y') }}</span>
                  <p>{{$comment->comment}}</p>
                  <div class="row" id="test">
                    <div class="col-md-12">
                      <label class="heart-comment @foreach($user_like_comments as $user_like_comment) @if($user_like_comment->user_id == Auth::user()->id) @if($user_like_comment->comment_id == $comment->id) @if($user_like_comment->is_fav == 1) heart-comment-active @endif @endif @endif @endforeach" data-commentid="{{$comment->id}}" data-userid="{{Auth::user()->id}}" >
                        ❤</label>
                      <label>&nbsp&nbsp</label>
                      @if($comment->fav_comment_count($comment->id) != 0)
                        <label class="fav-comment-counting{{$comment->id}}">{{$comment->fav_comment_count($comment->id)}}</label>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @endif
            @endforeach
          </div>
        </div>
        <div class="card comment-card comment-card-{{ $post->id }}">
          <div class="card-body">
            <div class="row">
              <div class="col-2 pl-4">
                <div class="avatar-comment">
                  <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <a href="/profile/{{$user->username}}"><div class="imageAvatar-comment" style="background-image: url('../storage/upload/{{ Auth::user()->avatar }}');"></div></a>
                </div>
              </div>
              <div class="col-10 pl-0">
                <form>
                  @csrf
                  <input type="hidden" name="post_id" class="post_id2" value="{{ $post->id }}">
                  <input type="hidden" name="user_id" class="user_id" value="{{ Auth::user()->id }}">
                  <textarea class="commentcontent{{$post->id}} form-control" name="comment" placeholder="Comment..." rows="2"></textarea>
                  <div class="row mt-2">
                    <div class="col-6"></div>
                    <div class="col-6">
                      <button type="button" name="comment-btn" class="comment-btn btn btn-primary pull-right post-comment" data-postid="{{ $post->id }}" data-userid="{{ Auth::user()->id }}" style="width: 40%;">Comment</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
