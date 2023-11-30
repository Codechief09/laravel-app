<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<title>test</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- flatpickr -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>

	<!-- moment.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
	<!-- Headタグ内に足す。Webpackによるcssの読み込み -->
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/original.css') }}">
</head>
<body>
	<div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        	<!-- Header Logo -->
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
				<!-- Navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar  -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <!-- ヘルパ関数を用いて引数で渡したコントローラー名のいずれかが現在のコントローラー名と一致すればactiveクラスを追加 -->
                        @guest
                            <li class="nav-item @if (my_is_current_controller('login', 'password')) active @endif">
                            <a class="nav-link" href="{{  route('login')  }}">
                                {{ __('Login') }} 
                                @if (my_is_current_controller('login', 'password')) 
                                <span class="sr-only">(current)</span> 
                                @endif</a>
                        </li>

                            @if (Route::has('register'))
                                <li class="nav-item @if (my_is_current_controller('register')) active @endif">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                    @if (my_is_current_controller('register'))
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- onclickイベントでaタグをクリックした場合の画面遷移をキャンセルして#logout-formのformを実行する -->
                                    <a class="dropdown-item" href="{{ route('reserve.form') }}">
                                        {{ __('Reserve') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('reserve.index') }}">
                                        {{ __('Confirm Reservation') }}
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    
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
        <main class="my-5">
            @yield('content')
        </main>
    </div>
<!-- holiday-jp これだけは直読みさせる（ブラウザ反映のため）-->
<script src="./js/holiday_jp.js"></script>
<!-- 独自に設定したjs -->
<script src=" {{ mix('js/original.js') }} "></script>
<!-- npmで入れているjs -->
<script src=" {{ mix('js/app.js') }} "></script>
</body>
</html>