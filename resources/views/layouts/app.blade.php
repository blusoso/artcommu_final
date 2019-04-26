<!DOCTYPE html>
<html>
  <head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  </head>
  <body>
    @guest
      <div class="register-login-btn pull-right mr-5">
        <a href="{{ route('login') }}" id="register-btn" class="btn btn-danger m-4">{{ __('Login') }}</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" id="login-btn" class="btn btn-success ">{{ __('Register') }}</a>
        @endif
      </div>
    @else
    <nav class="navbar navbar-expand-md navbar-expand-sm">
      <figure class="container m-auto row">
          <div class="col-xl-6 col-lg-5 col-md-2 col-1 pl-0">
            <ul class="m-0">
              <li><a href="/home" class="nav-active logo"><img src="{{asset('images/icons/stamp.png')}}" />&nbsp Community</a></li>
            </ul>
          </div>
          <div class="col-xl-6 col-lg-7 col-md-10 col-11">
            <div class="row">
              <div class="col-md-3 col-sm-3">
                <ul class="m-0">
                  <li class="nav-item">
                    <a href="#" class="nav-link"><img src="{{asset('images/icons/notifications.png')}}" alt=""> Notification</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-5 pr-0 col-sm-6">
                @foreach($users as $user)
                  @if ($user->id == Auth::user()->id)
                  <ul class="m-0">
                    <li class="nav-item">
                      <a class="avatar float-left ml-3" href="/profile/{{$user->username}}">
                        @if(Auth::user()->avatar == 'superhero.png')
                          <div class="imageAvatar" style="background-image: url('/../images/user/superhero.png');"></div>
                        @else
                          <div class="imageAvatar" style="background-image: url('/../storage/upload/{{ $user->avatar }}');"></div>
                        @endif
                      </a>
                    </li>
                    <li class="nav-item dropdown pull-right">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-center" href="#"  class="nav-link"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->display_name }} <span class="caret"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile/{{$user->username}}">
                            Profile
                        </a>
                        <a class="dropdown-item" href="/collection/{{$user->username}}">
                            Collection
                        </a>
                        <a class="dropdown-item" href="/settings/account">
                            Setting
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </div>
                    </li>
                  </ul>
              </div>
              <div class="col-md-4 col-sm-3">
                <ul class="m-0">
                  <li class="nav-item">
                    <a href="#"  class="nav-link btn btn-primary mx-2" data-toggle="modal" data-target="#createPostModal" >Post</a>
                  </li>
                </ul>
                @endif
              @endforeach
              </div>
            </div>
            </ul>
          </div>
    </figure>
  </nav>
  @include('createnewpostmodal')
  @endguest
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>
  </body>
</html>
