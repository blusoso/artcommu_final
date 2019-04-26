<div id="form-post">
  <form method="post" action="/post/insert" enctype="multipart/form-data">
    @csrf
    <div class="card post-card">
      <div class="card-body">
        <div class="row">
          <div class="col-1 pl-4">
            <div class="avatar-post">
              <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <a href="/profile/{{$user->username}}"><div class="imageAvatar-post" style="background-image: url('../storage/upload/{{ $user->avatar }}');"></div></a>
            </div>
          </div>
          <div class="col-11 px-4">
            <textarea class="form-control" name="status" id="status" placeholder="Description..." rows="3"></textarea>
            <div class="row mt-2">
              <div class="col-6">
                <input type='file' id="images" name="images[]" multiple="multiple" accept=".png, .jpg, .jpeg" />
                <label for="images"></label>
              </div>
              <div class="col-6">
                <button type="submit" name="post-btn" id="post-btn" class="btn btn-primary pull-right">Post</button>
              </div>
              <ul id="list-view" class="pl-3"></ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
