@extends('layouts.app') @section('content')
    <div class="card card-body border-0 p-2 mb-3">
        <div class="d-flex gap-3 p-2">
            <span class="h4 fw-bold text-primary my-auto">@lang('m.clubs')</span>
            <button class="btn btn-primary ms-auto my-auto" type="button" data-bs-toggle="modal" data-bs-target="#add">@lang('icon', ['s' => 20, 'i' => 'plus'])</button>
            <button class="btn btn-primary d-lg-none ms-auto my-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#search" aria-controls="search">@lang('icon', ['s' => 20, 'i' => 'filter'])</button>
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
                    <form action="{{ route('clubs.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">@lang('club.title')</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">@lang('club.type')</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="sciense">@lang('club.type.sciense')</option>
                                <option value="subject">@lang('club.type.subject')</option>
                                <option value="sport">@lang('club.type.sport')</option>
                                <option value="creative">@lang('club.type.creative')</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">@lang('club.description')</label>
                            <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-3">
        <div class="w-100">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mb-3">
                @foreach ($clubs as $club)
                    <div class="col">
                        <a class="text-decoration-none card" href="{{route('clubs.get', ['id'=>$club->id])}}">
                            <div class="card-body text-center">
                                <img class="avatar avatar-128 rounded-circle" src="{{json_decode($club->thumbnail)}}"> <br>
                                <span class="h4 text-primary fw-bold mt-2">{{ $club->title }}</span> <br>
                                <span class="small mb-2">@lang('club.type.'.$club->type)</span>
                                <div class="d-flex gap-3">
                                    <div class="card border-0 w-100">
                                        <div class="card-body text-center lh-1">
                                            <span class="h5 fw-bold">{{$club->readers()}}</span> <br>
                                            <span class="small">@lang('club.reader.count')</span>
                                        </div>
                                    </div>
                                    <div class="card border-0 w-100">
                                        <div class="card-body text-center lh-1">
                                            <span class="h5 fw-bold">{{$club->entryed()}}</span><br>
                                            <span class="small">@lang('club.entryed.count')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{ $clubs->appends(request()->input())->links() }}
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
                        <form action="{{ route('clubs.search') }}" method="get">
                            <div class="d-flex flex-column gap-2 mb-2">
                                <div class="">
                                    <label for="title" class="form-label">@lang('filter.book.title')</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', request('title')) }}">
                                </div>
                                <div class="">
                                    <label for="type" class="form-label">@lang('club.type')</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">@lang('all')</option>
                                        <option value="sciense" {{ old('type', request('type')) == 'sciense' ? 'selected' : '' }}>
                                            @lang('club.type.sciense')
                                        </option>
                                        <option value="subject" {{ old('type', request('type')) == 'subject' ? 'selected' : '' }}>
                                            @lang('club.type.subject')
                                        </option>
                                        <option value="sport" {{ old('type', request('type')) == 'sport' ? 'selected' : '' }}>
                                            @lang('club.type.sport')
                                        </option>
                                        <option value="creative" {{ old('type', request('type')) == 'creative' ? 'selected' : '' }}>
                                            @lang('club.type.creative')
                                        </option>
                                    </select>
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
