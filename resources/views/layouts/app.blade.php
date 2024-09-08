<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3.0.1/es5/tex-mml-chtml.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="bg-body-secondary">
    <div class="сontainer-fluid">
        <div class="d-flex gap-3">
            <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="menu" aria-labelledby="menuLabel">
                <div class="offcanvas-header py-2">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#menu"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="min-width: 250px;">
                    <div class="card w-100 overflow-y-auto border-0" style="height: 100dvh">
                        <div class="card-body d-flex flex-column p-2">
                            <div class="card mb-2">
                                <div class="card-body p-2 d-flex gap-2">
                                    @if (Auth::user()->avatar)
                                        <img class="avatar avatar-48 rounded-circle" src="{{ Auth::user()->avatar }}">
                                    @else
                                        <span
                                            class="avatar avatar-48 rounded-circle bg-primary my-auto">{{ Auth::user()->avatar }}</span>
                                    @endif
                                    <div class="my-auto lh-1">
                                        <span class="fw-medium">{{ Auth::user()->name }}</span><br>
                                        <span class="small text-muted">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <a href="/" class="btn bg-body-secondary border text-start mb-2">
                                @lang('icon', ['s' => 20, 'i' => 'home'])
                                @lang('m.home')
                            </a>

                            <a href="{{route('game')}}" class="btn bg-body-secondary border text-start mb-2">
                                @lang('icon', ['s' => 20, 'i' => 'device-gamepad-2'])
                                @lang('m.game')
                            </a>

                            <a href="{{ route('users.profile') }}" class="btn bg-body-secondary border text-start mb-2">
                                @lang('icon', ['s' => 20, 'i' => 'user'])
                                @lang('m.profile')
                            </a>

                            <div class="btn-group-vertical mb-2">
                                <a href="{{ route('books.all') }}" class="btn bg-body-secondary border text-start">
                                    @lang('icon', ['s' => 20, 'i' => 'books'])
                                    @lang('m.books')
                                </a>

                                <a href="{{ route('books.exchange') }}" class="btn bg-body-secondary border text-start">
                                    @lang('icon', ['s' => 20, 'i' => 'arrows-exchange'])
                                    @lang('m.book-exchange')
                                </a>

                                <a href="{{ route('users.profile.my_collections') }}"
                                    class="btn bg-body-secondary border text-start">
                                    @lang('icon', ['s' => 20, 'i' => 'cards'])
                                    @lang('m.my-collections')
                                </a>
                            </div>

                            <a href="{{ route('clubs.all') }}" class="btn bg-body-secondary border text-start mb-2">
                                @lang('icon', ['s' => 20, 'i' => 'users-group'])
                                @lang('m.clubs')
                            </a>

                            <div class="card bg-body-secondary mt-auto mb-2 border">
                                <div class="card-body d-flex gap-2 p-1">
                                    <a href="/language/kk"
                                        class="btn p-2 w-100 @if (App::isLocale('kk')) bg-body text-primary @else border-0 @endif rounded">Қазақша</a>
                                    <a href="/language/ru"
                                        class="btn p-2 w-100 @if (App::isLocale('ru')) bg-body text-primary @else border-0 @endif rounded">Русский</a>
                                    <a href="/language/en"
                                        class="btn p-2 w-100 @if (App::isLocale('en')) bg-body text-primary @else border-0 @endif rounded">English</a>
                                </div>
                            </div>

                            <button class="btn btn-danger w-100 text-start"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                @lang('icon', ['s' => 20, 'i' => 'logout'])
                                {{ __('logout') }}
                            </button>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 overflow-y-auto p-2" style="height: 100dvh">
                <nav class="navbar navbar-expand-md navbar-light bg-white rounded m-0 mb-3 sticky-top">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>

                        <div class="" id="navbarSupportedContent">
                            <button class="btn btn-primary d-lg-none ms-auto my-auto" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 6l16 0" />
                                    <path d="M4 12l16 0" />
                                    <path d="M4 18l16 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </nav>
                @yield('content')
            </div>
        </div>
    </div>
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>

            <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if (session('success'))
            var successToast = new bootstrap.Toast(document.getElementById('successToast'));
            successToast.show();
        @endif

        @if (session('error'))
            var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
            errorToast.show();
        @endif
    </script>
</body>

</html>
