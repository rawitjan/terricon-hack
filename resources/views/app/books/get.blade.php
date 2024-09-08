@extends('layouts.app')

@section('content')
    <div class="row g-3">
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-sm-4 text-md-start text-center">
                        <img src="{{ $book->thumbnail }}" class="img-fluid rounded w-75" alt="...">
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                            <div class="lh-1 text-md-start text-center">
                                <div class="d-flex gap-1 me-auto">
                                    <span class="my-auto"><x-ui.star-rating :rating="$book->rating()" id="book" /></span>
                                    <span class="my-auto">({{ round($book->rating(), 1) }})</span>
                                </div>
                                <span class="h1 fw-bold text-primary">{{ $book->title }}</span><br>
                                <span class="fw-bold h4 text-muted">{{ $book->subtitle }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <span class="fw-semibold">@lang('book.authors')</span>
                                <span>{{ $book->authors }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <span class="fw-semibold">@lang('book.categories')</span>
                                <span>{{ $book->categories }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <span class="fw-semibold">@lang('book.isbn10')</span>
                                <span>{{ $book->isbn10 }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <span class="fw-semibold">@lang('book.publish_year')</span>
                                <span>{{ $book->publish_year }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <span class="fw-semibold">@lang('book.num_pages')</span>
                                <span>{{ $book->num_pages }}</span>
                            </div>

                            <div class="accordion mb-3" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            @lang('book.description')
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">{!! $book->description !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm">
                                    <button class="btn btn-outline-primary w-100">
                                        @lang('icon', ['s' => 20, 'i' => 'share-3'])
                                        @lang('book.share.post')
                                    </button>
                                </div>
                                <div class="col-sm">
                                    <button class="btn btn-primary w-100"  data-bs-toggle="modal" data-bs-target="#add_col">
                                        @lang('icon', ['s' => 20, 'i' => 'cards'])
                                        @lang('book.add.collection')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add_col" tabindex="-1" aria-labelledby="add_colLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="add_colLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('books.add_collections', ['id'=>$book->id]) }}" method="post">
                                @csrf
                                <label for="id" class="form-label">@lang('collections')</label>
                                <select name="id" id="id" class="form-select mb-3">
                                    @foreach (Auth::user()->collections as $collection)
                                        <option value="{{$collection->id}}">{{ $collection->title }} ({{$collection->books->count()}})</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('books.comment', ['id' => $book->id]) }}" method="post">
                        @csrf
                        <div class="d-flex">
                            <span class="my-auto">@lang('book.add.comment')</span>
                            <div class="ms-auto my-auto">
                                <x-ui.star-rating id="commenting" />
                            </div>
                        </div>

                        <textarea name="comment" id="comment" rows="2" class="form-control mb-2" placeholder="-"></textarea>
                        <div class="d-flex"><button type="submit"
                                class="btn btn-primary ms-auto">@lang('submit')</button></div>

                    </form>
                </div>
            </div>
            <div class="card card-body mb-3"><span class="h5 fw-bold text-primary">@lang('book.another.comments')</span></div>

            @foreach ($book->comments as $comment)
                <div class="card @if ($comment->user_id == Auth::user()->id) border-2 border-primary @endif mb-2">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <span
                                class="avatar avatar-48 rounded-circle bg-primary my-auto">{{ $comment->reader->initials }}</span>
                            <div class="my-auto lh-1">
                                <span class="h5 fw-bold ">{{ $comment->reader->name }}</span><br>
                                <small class="text-muted">{{ $comment->updated_at }}</small>
                            </div>
                            <div class="my-auto ms-auto">
                                <x-ui.star-rating id="{{ $comment->id }}_reader_comment" :rating="$comment->star" />
                            </div>
                        </div>
                        @if (isset($comment->body))
                            <div class="card card-body mt-2 p-2">
                                {{ $comment->body }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-3">
            <div class="d-flex flex-column gap-3">
                @if ($book->another_books_author->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <span class="h5 fw-bold text-primary mb-3">@lang('author.books')</span>
                            @foreach ($book->another_books_author as $ab)
                                <div class="card mb-3">
                                    <div class="card-body p-0">
                                        <img src="{{ $ab->thumbnail }}" alt="" class="w-100 img-fluid rounded">
                                        <div class="p-2">
                                            <div class="d-flex gap-1 me-auto">
                                                <span class="my-auto"><x-ui.star-rating :rating="$ab->rating()"
                                                        id="ab_book_" /></span>
                                                <span class="my-auto">({{ round($ab->rating(), 1) }})</span>
                                            </div>
                                            <span class="fw-medium">{{ $ab->title }}</span><br>
                                            <span class="small text-muted">{{ $ab->authors }}
                                                [{{ $ab->publish_year }}]</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($book->another_books_category->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <span class="h5 fw-bold text-primary mb-3">@lang('category.books')</span>
                            @foreach ($book->another_books_category as $ab)
                                <div class="card mb-3">
                                    <div class="card-body p-0">
                                        <img src="{{ $ab->thumbnail }}" alt="" class="w-100 img-fluid rounded">
                                        <div class="p-2">
                                            <div class="d-flex gap-1 me-auto">
                                                <span class="my-auto"><x-ui.star-rating :rating="$ab->rating()"
                                                        id="ab_book_" /></span>
                                                <span class="my-auto">({{ round($ab->rating(), 1) }})</span>
                                            </div>
                                            <span class="fw-medium">{{ $ab->title }}</span><br>
                                            <span class="small text-muted">{{ $ab->authors }}
                                                [{{ $ab->publish_year }}]</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
