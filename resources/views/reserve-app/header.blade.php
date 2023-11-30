@extends('layouts.parent')
@section('header')
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

                                    <a class="dropdown-item" href="#">
                                        {{ __('Reserve') }}
                                    </a>
									
                                </div>
                            </li>
                        @endguest

                        <!-- 言語切替のメニュー -->
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
@endsection