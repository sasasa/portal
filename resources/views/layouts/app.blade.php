<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?{{ str_random(8) }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?{{ str_random(8) }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', '整体院ナビ') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login_shop') }}">店舗{{ __('Login') }}</a>
                            </li>
                        @else
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="/home_admin">管理者home</a>
                                </li>
                            @endif
                            @if (Auth::user()->role == 'shop')
                                <li class="nav-item">
                                    <a class="nav-link" href="/home_shop">店舗home</a>
                                </li>
                            @endif
                            @if (Auth::user()->role == 'user')
                                <li class="nav-item">
                                    <a class="nav-link" href="/home">home</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
    <footer>
        <ul class="footer_nav">
            <li>
            <a href="/terms_of_use">利用規約</a>
            </li>
            <li>
            <a href="/management_company">運営会社</a>
            </li>
            <li>
            <a href="/privacy_policy">プライバシーポリシー</a>
            </li>
            <li>
            <a href="/how_to_publish">店舗・施設の掲載をお考えの方へ</a>
            </li>
        </ul>
        <div class="footer_inner">
            ©Grow-up, Inc. All Rights reserved.
        </div>
    </footer>
    @yield('script')
</body>
</html>
