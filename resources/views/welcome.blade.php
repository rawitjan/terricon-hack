<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body class="bg-body-tertiary">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <x-ui.lang-switch />
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary">@lang('login')</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3 my-3">
            @foreach ($books as $book)
                <div class="col">
                    <div class="card">
                        <div class="card-body p-0">
                            <img src="{{ $book->thumbnail }}" alt="" class="img-fluid w-100 rounded">
                            <div class="m-3">
                                <a class="btn btn-sm bg-primary bg-opacity-75 pe-none">{{$book->categories}}</a><br>
                                <span class="fw-bold h4 text-primary">{{ $book->title }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $books->links() }}

        <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-3 mt-3">
            @foreach ($categoryes_limit as $category)
                <div class="col">
                    {{ $category }}
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
