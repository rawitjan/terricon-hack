@extends('layouts.app')

@section('content')
    <div class="card card-body border-0 p-2 mb-3">
        <div class="d-flex gap-3 p-2">
            <span class="h4 fw-bold text-primary my-auto">@lang('m.book-exchange')</span>
            <button class="btn btn-primary d-lg-none ms-auto my-auto" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#search" aria-controls="search">@lang('icon', ['s' => 20, 'i' => 'filter'])</button>
            <button class="btn btn-primary ms-auto my-auto" type="button" data-bs-toggle="modal" data-bs-target="#exp">@lang('icon', ['s' => 20, 'i' => 'plus'])</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exp" tabindex="-1" aria-labelledby="expLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="expLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('books.exchange.publish') }}" class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="thumbnail" class="form-label">@lang('book-exc.thumbnail')</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control" required accept="image/*">
                        </div>
                        <div>
                            <label for="data[my-book]" class="form-label">@lang('book-exc.my-book')</label>
                            <input type="text" name="data[my-book]" id="data[my-book]" class="form-control" required>
                        </div>
                        <div>
                            <div class="d-flex gap-3">
                                <input type="radio" class="btn-check" name="data[type]" id="exchange" autocomplete="off" checked required value="exchange">
                                <label class="btn btn-outline-primary w-100" for="exchange">@lang('book-exc.exchange')</label>

                                <input type="radio" class="btn-check" name="data[type]" id="free" autocomplete="off" required value="free">
                                <label class="btn btn-outline-primary w-100" for="free">@lang('book-exc.free')</label>
                            </div>
                        </div>
                        <div>
                            <label for="data[exc-to]" class="form-label">@lang('book-exc.exc-to')</label>
                            <input type="text" name="data[exc-to]" id="data[exc-to]" class="form-control">
                        </div>
                        <div>
                            <label for="body" class="form-label">@lang('book-exc.description')</label>
                            <textarea name="body" id="body" rows="2" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <div class="w-100">
            @foreach ($posts as $post)
                <x-ui.post-card :id="$post->id" /> <div class="mb-2"></div>
            @endforeach
        </div>
        <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="search" aria-labelledby="searchLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#search"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" style="min-width: 250px;">
                <div class="card w-100 h-100 border-0">
                    <div class="card-body p-2">
                        <div class="d-flex gap-3 mb-3">
                            <button class="btn btn-primary my-auto pe-none">@lang('icon', ['s' => 20, 'i' => 'filter'])</button>
                            <span class="fw-medium my-none">@lang('filter')</span>
                        </div>
                        <form action="{{ route('books.search') }}" method="get">

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
