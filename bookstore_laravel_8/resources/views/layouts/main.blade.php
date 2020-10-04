<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>مكتبة حسوب</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/597cb1f685.js" crossorigin="anonymous"></script>
    <style>
        .score {
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        .score-wrap {
            display: inline-block;
            position: relative;
            height: 19px;
        }
        .score .stars-active {
            color: #FFCA00;
            position: relative;
            z-index: 10;
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
        }
        .score .stars-inactive {
            color: lightgrey;
            position: absolute;
            top: 0;
            left: 0;
        }
        .rating {
            overflow: hidden;
            display: inline-block;
            position: relative;
            font-size: 20px;
        }
        .rating-star {
            padding: 0 5px;
            margin: 0;
            cursor: pointer;
            display: block;
            float: left;
        }
        .rating-star:after {
            position: relative;
            font-family: "Font Awesome 5 Free";
            content: '\f005';
            color: lightgrey;
        }
        .rating-star.checked ~ .rating-star:after,
        .rating-star.checked:after {
            content: '\f005';
            color: #FFCA00;
        }
        .rating:hover .rating-star:after {
            content: '\f005';
            color: lightgrey;
        }
        .rating-star:hover ~ .rating-star:after,
        .rating .rating-star:hover:after {
            content: '\f005';
            color: #FFCA00;
        }
        

    </style>
</head>
<body dir="rtl" style="text-align: right">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    مكتبة حسوب
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.view') }}">
                                    @if(Auth::user()->booksInCart()->count() > 0)
                                        <span class="badge badge-secondary">{{ Auth::user()->booksInCart()->count() }}</span>
                                    @endif
                                        العربة 
                                    <i class="fas fa-shopping-cart"></i> 
                                </a>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery.categories.index') }}">                                
                                    التصنيفات 
                                <i class="fas fa-list"></i> 
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery.publishers.index') }}">                                
                                    الناشرون 
                                <i class="fas fa-table"></i> 
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery.authors.index') }}">                                
                                    المؤلفون 
                                <i class="fas fa-pen"></i> 
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('إنشاء حساب') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown justify-content-left">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2" aria-labelledby="navbarDropdown">
                                    @can('update-books')
                                        <a href="{{ route('admin.index') }}" class="dropdown-item text-right">لوحة الإدارة</a>
                                    @endcan
                                    <!-- Responsive Settings Options -->
                                    <div class="pt-4 pb-1 border-t border-gray-200">
                                        <div class="flex items-center px-4">
                                            <div class="flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full ml-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            </div>

                                            <div class="ml-3">
                                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                            </div>
                                        </div>

                                        <div class="mt-3 space-y-1">
                                            <!-- Account Management -->
                                            <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')" class="dropdown-item">
                                                {{ __('الملف الشخصي') }}
                                            </x-jet-responsive-nav-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-jet-responsive-nav-link href="/user/api-tokens" :active="request()->routeIs('api-tokens.index')" class="dropdown-item">
                                                    {{ __('API Tokens') }}
                                                </x-jet-responsive-nav-link>
                                            @endif

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-jet-responsive-nav-link href="{{ route('logout') }}" class="dropdown-item"
                                                                onclick="event.preventDefault();
                                                                            this.closest('form').submit();">
                                                    {{ __('تسجيل خروج') }}
                                                </x-jet-responsive-nav-link>
                                            </form>

                                            <!-- Team Management -->
                                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                                <div class="border-t border-gray-200"></div>

                                                <div class="block px-4 py-2 text-xs text-gray-400" class="dropdown-item">
                                                    {{ __('إدارة الفريق') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-jet-responsive-nav-link href="/teams/{{ Auth::user()->currentTeam->id }}" :active="request()->routeIs('teams.show')" class="dropdown-item">
                                                    {{ __('إعدادات الفريق') }}
                                                </x-jet-responsive-nav-link>

                                                <x-jet-responsive-nav-link href="/teams/create" :active="request()->routeIs('teams.create')" class="dropdown-item">
                                                    {{ __('إنشاء فريق جديد') }}
                                                </x-jet-responsive-nav-link>

                                                <div class="border-t border-gray-200"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400" class="dropdown-item">
                                                    {{ __('تبديل الفريق') }}
                                                </div>

                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
</body>
</html>
