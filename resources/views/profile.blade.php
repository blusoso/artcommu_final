@extends('layouts.app')

@section('content')
  @include('profile-header')
  <div id="page-profile">
    <div class="container-fluid">
      <div class="container pt-2">
        <div class="row">
          <div class="col-lg-3 col-sm-12 pr-2">
            <div class="card bio-card">
              <div class="card-body px-5">
                <div class="row">
                  <div class="col-lg-10">
                    @foreach($users as $user)
                      @if($user->username == $username)
                    <h5 class="bio-displayname">{{ $user->display_name }}</h5>
                  </div>
                  <div class="col-lg-2 p-0">
                      @if(Auth::user()->username == $username)
                        <a href="#" id="edit-bio-btn" data-toggle="modal" data-target="#editBioModal" data-bio="{{$user->bio}}" data-biolink="{{$user->bio_link}}">Edit</a>
                      @endif
                  </div>
                </div>
                <p class="bio-content mt-2">{{ $user->bio }}</p>
                <a class="link" href="{{ $user->bio_link }}">{{ $user->bio_link }}</a>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-sm-12 pl-0">
            @if(Auth::user()->id == $user->id)
              @include('formpost')
            @endif
            <div class="card topic-card">
              <div class="card-body">
                <h5>Post</h5>
              </div>
            </div>
            <div class="card default-card">
              <div class="card-body pt-0">
<<<<<<< HEAD
                @if(Auth::user()->id != $user->id)
                  @foreach($posts as $post)
                    @if($post->user_id == $user->id)
                      @include('mypost')
                    @endif
                  @endforeach
                @else
                  @if($posts_count > 0)
                      @if($post->user_id == $user->id)
                        @include('mypost')
                      @endif
                  @else
                      <div class="no-content text-center font-weight-bold text-muted my-5">
                        <h5>No any post now.</h5>
                        <h1>Let's post your first work!</h1>
                      </div>
                  @endif
=======
                @if($posts_count > 0)
                  @foreach($posts as $post)
                    @if($post->user_id == $user->id)
                      @include('postcontent')
                    @endif
                  @endforeach
                @else
                  <div class="no-content text-center font-weight-bold text-muted my-5">
                    <h5>No any post now.</h5>
                    <h1>Let's post your first work!</h1>
                  </div>
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      @include('footer')
    </div>
  </div>
  @endif
@endforeach

  <!-- modal -->
  <div class="modal fade" id="editBioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit your bio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success hidden" role="alert">
            Updated Success
          </div>
          <form>
            <div class="form-group">
              <div class="row">
                <div class="col-3">
                  {{ csrf_field() }}
                  <input type="hidden" id="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                </div>
              </div>
              <div class="row my-2">
                <div class="col-3">
                  <label for="Bio-description">Bio</label>
                </div>
                <div class="col-9">
                  <textarea class="form-control" name="bio-description" id="bio-description" rows="5" value=""></textarea>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-3">
                  <label for="Bio-link">Link</label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" name="bio-link" id="bio-link" val=""/></input>
                  <p class="mt-2 ex-bio">Example: https://example.com, www.example.com</p>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input id="save-bio-btn" type="button" class="btn btn-primary" value="Save">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal -->
  @include('savetocollectionmodal')
  @include('createcollectionmodal')

@endsection
