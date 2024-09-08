@extends('layouts.app')

@section('content')
<div class="card card-body border-0 p-2 mb-3">
    <div class="d-flex gap-3 p-2">
        <span class="h4 fw-bold text-primary my-auto">@lang('m.books')</span>
        <button class="btn btn-primary d-lg-none ms-auto my-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#search" aria-controls="search">@lang('icon', ['s' => 20, 'i' => 'filter'])</button>
    </div>
</div>

<div class="d-flex gap-3">
    <div class="w-100">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-3">
            @foreach ($books as $book)
                <div class="col">
                    <a href="{{ route('books.get', ['id' => $book->id]) }}" class="card text-decoration-none">
                        <div class="card-body p-0">
                            <img src="{{$book->thumbnail}}" alt="{{$book->title}}" class="img-fluid w-100 rounded">
                            <div class="p-2">
                                <div class="d-flex gap-1 me-auto">
                                    <span class="my-auto"><x-ui.star-rating :rating="$book->rating()" id="book" /></span>
                                    <span class="my-auto">({{ round($book->rating(), 1) }})</span>
                                </div>
                                <span class="h5 fw-medium">{{ $book->title }}</span><br>
                                <span class="small text-muted">{{ $book->authors }} [{{ $book->publish_year }}]</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $books->appends(request()->input())->links() }}
    </div>
    <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="search" aria-labelledby="searchLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#search" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="min-width: 250px;">
            <div class="card w-100 h-100 border-0">
                <div class="card-body p-2">
                    <div class="d-flex gap-3 mb-3">
                        <button class="btn btn-primary my-auto pe-none">@lang('icon', ['s' => 20, 'i' => 'filter'])</button>
                        <span class="fw-medium my-none">@lang('filter')</span>
                    </div>
                    <form action="{{ route('books.search') }}" method="get">
                        <div class="d-flex flex-column gap-2 mb-2">
                            <div class="">
                                <label for="title" class="form-label">@lang('filter.book.title')</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', request('title')) }}">
                            </div>
                            <div class="">
                                <label for="authors" class="form-label">@lang('filter.book.authors')</label>
                                <input type="text" name="authors" id="authors" class="form-control" value="{{ old('authors', request('authors')) }}">
                            </div>
                            <div class="">
                                <label for="categories" class="form-label">@lang('filter.book.categories')</label>
                                <input type="text" name="categories" id="categories" class="form-control" value="{{ old('categories', request('categories')) }}">
                            </div>
                            <div class="">
                                <label for="publish_year" class="form-label">@lang('filter.book.publish_year')</label>
                                <input type="number" name="publish_year" id="publish_year" class="form-control" value="{{ old('publish_year', request('publish_year')) }}">
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">
                            @lang('icon', ['s' => 20, 'i' => 'search'])
                            @lang('search')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
