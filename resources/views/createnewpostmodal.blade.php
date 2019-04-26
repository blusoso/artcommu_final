<!-- modal -->
<div id="createnewpost">
  <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="/post/insert" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-2 pl-4">
                @foreach($users as $user)
                  @if ($user->id == Auth::user()->id)
                    <div class="avatar-post">
                      <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        <a href="/profile/{{$user->username}}"><div class="imageAvatar-post" style="background-image: url('../storage/upload/{{ $user->avatar }}');"></div></a>
                    </div>
                  </div>
                  <div class="col-10 px-4">
                    <textarea class="form-control" name="status" id="statusmodal" placeholder="Description..." rows="3"></textarea>
                    <div class="row mt-2">
                      <div class="col-6">
                        <input type='file' id="imagesmodal" name="images[]" multiple="multiple" accept=".png, .jpg, .jpeg" />
                        <label for="images"></label>
                      </div>
                      <div class="col-6">
                        <button type="submit" name="post-btn" id="post-btn" class="btn btn-primary pull-right post-comment">Post</button>
                      </div>
                      <ul id="list-viewmodal" class="pl-3"></ul>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- end modal -->
</div>
