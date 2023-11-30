<!doctype html>

<!-- アンダーバーをハイフンに置き換えする。 -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (! Request::is('/')) {{ $title ?? '' }} | @endif{{ env('APP_NAME') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>body{background-color: #26263c;}</style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar  -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item @if (my_is_current_controller('login', 'password')) active @endif">
                            <a class="nav-link" href="{{  route('admin.login')  }}">
                                {{ __('Login') }} 
                                @if (my_is_current_controller('login', 'password')) 
                                <span class="sr-only">(current)</span> 
                                @endif</a>
                        </li>

                            @if (Route::has('admin.register'))
                                <li class="nav-item @if (my_is_current_controller('register')) active @endif">
                                <a class="nav-link" href="{{ route('admin.register') }}">
                                    {{ __('Register') }}
                                    @if (my_is_current_controller('register'))
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::Admin()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown-lang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('locale.'.App::getLocale()) }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-lang">
                                @if (!App::isLocale('en'))
                                    <a class="dropdown-item" href="{{ my_locale_url('en') }}">
                                        {{ __('locale.en') }}
                                    </a>
                                @endif
                                @if (!App::isLocale('ja'))
                                    <a class="dropdown-item" href="{{ my_locale_url('ja') }}">
                                        {{ __('locale.ja') }}
                                    </a>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
