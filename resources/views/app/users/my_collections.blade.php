@extends('layouts.app') @section('content')
    <div class="card card-body border-0 p-2 mb-3">
        <div class="d-flex gap-3 p-2">
            <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#collections" aria-controls="collections">@lang('icon', ['s' => 20, 'i' => 'list'])</button>
            <span class="h4 fw-bold text-primary my-auto">@lang('m.my-collections')</span>
            <button class="btn btn-primary ms-auto my-auto" type="button" data-bs-toggle="modal" data-bs-target="#add">@lang('icon', ['s' => 20, 'i' => 'plus'])</button>
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.profile.collection.create') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">@lang('collection.title')</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-3">
        <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="collections" aria-labelledby="collectionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="collectionsLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#collections" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" style="min-width: 230px;">
                <div class="w-100">
                    @foreach (Auth::user()->collections as $collection)
                        <a href="{{ route('users.profile.my_collections.v', ['id'=>$collection->id]) }}" class="text-decoration-none card w-100 mb-2 @if(isset($c) and $collection->id == $c->id) border-2 border-primary @else border-0 @endif">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <span class="h5 fw-bold">{{$collection->title}}</span>
                                    <button class="btn btn-primary btn-sm ms-auto">@lang('icon', ['s' => 20, 'i' => 'books']){{ $collection->books->count() }}</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-100">
            @if (!isset($c))
                <div class="card card-body border-danger border-2">
                    @lang('collection.not.found')
                    @foreach (Auth::user()->collections as $collection)
                        <a href="{{ route('users.profile.my_collections.v', ['id'=>$collection->id]) }}" class="text-decoration-none card w-100 mb-2 @if(isset($c) and $collection->id == $c->id) border-2 border-primary @else border-0 @endif">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <span class="h5 fw-bold">{{$collection->title}}</span>
                                    <button class="btn btn-primary btn-sm ms-auto">@lang('icon', ['s' => 20, 'i' => 'books']){{ $collection->books->count() }}</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @elseif($c->user_id != Auth::user()->id )
                <div class="card card-body border-danger border-2">
                    @lang('collection.not.found')
                    @foreach (Auth::user()->collections as $collection)
                        <a href="{{ route('users.profile.my_collections.v', ['id'=>$collection->id]) }}" class="text-decoration-none card w-100 mb-2 @if(isset($c) and $collection->id == $c->id) border-2 border-primary @else border-0 @endif">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <span class="h5 fw-bold">{{$collection->title}}</span>
                                    <button class="btn btn-primary btn-sm ms-auto">@lang('icon', ['s' => 20, 'i' => 'books']){{ $collection->books->count() }}</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-3">
                @foreach ($c->books as $book)
                <div class="col">
                    <a href="{{ route('books.get', ['id' => $book->data->id]) }}" class="card text-decoration-none">
                        <div class="card-body p-0">
                            <img src="{{$book->data->thumbnail}}" alt="{{$book->data->title}}" class="img-fluid w-100 rounded">
                            <div class="p-2">
                                <div class="d-flex gap-1 me-auto">
                                    <span class="my-auto"><x-ui.star-rating :rating="$book->data->rating()" id="book" /></span>
                                    <span class="my-auto">({{ round($book->data->rating(), 1) }})</span>
                                </div>
                                <span class="h5 fw-medium">{{ $book->data->title }}</span><br>
                                <span class="small text-muted">{{ $book->data->authors }} [{{ $book->data->publish_year }}]</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
                @if ($c->books->count() == 0)
                <div class="card card-body">
                    <span class="fw-semibold text-secondary">@lang('collection.not.books')</span>
                    <a href="{{ route('books.all') }}" class="btn btn-primary mt-2">
                        @lang('icon', ['s' => 20, 'i' => 'books'])
                        @lang('m.books')
                    </a>
                </div>
                @endif
            @endif
        </div>
    </div>
@endsection
