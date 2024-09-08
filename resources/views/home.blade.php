@extends('layouts.app')

@section('content')
    <div class="d-flex">
        <span class="h4 my-3 fw-bold">@lang('top5.books')</span>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2">
        @foreach ($books as $book)
            <div class="col">
                <a href="{{ route('books.get', ['id' => $book->id]) }}" class="card text-decoration-none">
                    <div class="card-body p-0">
                        <img src="{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid w-100 rounded">
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
        <div class="col">
            <a href="{{ route('books.all') }}"
                class="text-decoration-none fw-bold text-primary border-2 border-primary card h-100 card-body">
                <div class="d-flex w-100 h-100">
                    <div class="m-auto text-center">
                        @lang('icon', ['s' => 80, 'i' => 'books']) <br>
                        @lang('m.books')
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="d-flex">
        <span class="h4 my-3 fw-bold">@lang('all.posts')</span>
    </div>
    @foreach ($posts as $post)
        <div class="mb-2">
            <x-ui.post-card :id="$post->id" />
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
