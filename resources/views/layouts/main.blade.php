<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Cooking tutorial</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/templatemo-style.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="placeholder">
            <div class="parallax-window" data-parallax="scroll" data-image-src="{{asset('img/2022.jpeg')}}">
                <div class="tm-header">
                    <div class="row tm-header-inner">
                        <div class="col-md-6 col-12">
                            <div class="tm-site-text-box">
                                <h1 class="tm-site-title">{{__('index.Cooking tutorial')}}</h1>
                                <h6 class="tm-site-description">{{__('index.new cookies\' recepies')}}</h6>
                            </div>
                        </div>
                        <nav class="col-md-6 col-12 tm-nav">
                            <ul class="tm-nav-ul" style="color:green">
                                <li class="tm-nav-li"><a href="{{route('index', app()->getLocale())}}" class="tm-nav-link">{{__('index.Home')}}</a></li>
                                <li class="tm-nav-li"><a href="{{route('contact', app()->getLocale())}}" class="tm-nav-link">{{__('index.Contact')}}</a></li>
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="tm-nav-li">
                                                <a class="tm-nav-link" href="{{ route('login') }}">{{ __('index.Login') }}</a>
                                            </li>
                                        @endif
                                        @if (Route::has('register'))
                                            <li class="tm-nav-li">
                                                <a class="tm-nav-link" href="{{ route('register') }}">{{ __('index.Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <div class="dropdown">
                                            <a class="tm-nav-link dropdown-toggle" data-toggle="dropdown">
                                                {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu">
                                                @if(Auth::user()->is_admin == 1)
                                                    <a class="dropdown-item" href="{{ route('foods.index') }}">{{__('index.Admin profile') }}</a>
                                                @endif
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('index.Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    @endguest
                                <li class="tm-nav-li">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            @if(app()->getLocale())
                                            {{strtoupper(app()->getLocale())}}
                                            @else
                                                EN
                                            @endif
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route(Route::currentRouteName(), 'ru')}}">RU</a>
                                            <a class="dropdown-item" href="{{route(Route::currentRouteName(), 'en' )}}">EN</a>
                                            <a class="dropdown-item" href="{{route(Route::currentRouteName(), 'uz' )}}">UZ</a>
                                        </div>
                                    </div>
                                </li>
                             </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
        <footer class="tm-footer text-center">
            <p>Copyright &copy; 2021 Cookies

                | Design: <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
        </footer>
    </div>
    <script>
        document.querySelector('select').onchange = function() {window.location = this.value}
    </script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/parallax.min.js')}}"></script>
</body>
</html>
