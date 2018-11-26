<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>

        window.LaravelChat = {!! json_encode([
            'csrfToken'=> csrf_token(),
            'user'=> [
                'authenticated' => auth()->check(),
                'id' => auth()->check() ? auth()->user()->id : null,
                'name' => auth()->check() ? auth()->user()->name : null,
                ]
            ])
        !!};

    </script>

        <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

    </script>


        <script>
    @if(!auth()->guest())
            window.Laravel.userId = <?php echo auth()->user()->id; ?>
        @endif
        </script>
</head>
<body>


    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <i class="fab fa-laravel"></i>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="nav navbar-nav">
                    &nbsp;
                    <li><a href="{{ url('/posts/create') }}">New Post</a></li>
                </ul>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">


                        </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}<i class="fas fa-sign-in-alt"></i></a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}<i class="fas fa-registered"></i></a>
                                @endif
                            </li>
                        @else

                            <li class="dropdown">
                                <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="glyphicon glyphicon-user"></span><i class="fas fa-bell"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                                    <li class="dropdown-header">No notifications</li>
                                </ul>
                            </li>


                            <form action="/search" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q"
                                           placeholder="Search users"> <span class="input-group-btn">
                                      <button type="submit"   class="btn btn-dark"><i class="fas fa-search"></i>
                                         <span class="glyphicon glyphicon-search"></span>
                                          </button>
                                              </span>
                                        </div>
                            </form>

                            <li class="nav-item dropdown">
                                <a  id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px;  border-radius:50%">
                                </a>



                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ url('/chat') }}">
                                        {{ __('Messenger') }}    <i class="far fa-envelope"></i>
                                    </a>

                                    <a class="dropdown-item" href="{{ url('/post') }}">
                                        {{ __('Add News') }} <i class="fas fa-folder-plus"></i>
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/image') }}">
                                        {{ __('Create Image in Albom') }} <i class="fas fa-folder-plus"></i>
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        {{ __('Profile') }} <i class="fas fa-user-circle"></i>
                                    </a>
                                    <a class="dropdown-item" href="{{action('HomeController@edit', Auth::user()->id)}}">
                                        {{ __('Edit Profile') }}  <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="dropdown-item" href="{{action('HomeController@editpass', Auth::user()->id)}}">
                                        {{ __('Edit Password') }} <i class="fab fa-expeditedssl"></i>
                                    </a>                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include ('layouts.partials._notifications')
                </div>
            </div>
        </div>

        <div class="container">
        <main class="py-4">
            @yield('content')
        </main>
        </div>
    </div>

    {{--Karevor--}}
    {{--<script src="/resources/js/app.js"></script>--}}

</body>
</html>
