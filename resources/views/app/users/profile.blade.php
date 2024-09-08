@extends('layouts.app')

@section('content')
    <div class="row g-3">
        <div class="col-sm-3">
            <div class="card border-0">
                <div class="card-body">
                    <div class="text-center">
                            @if ($user->avatar)
                            <img class="avatar avatar-128 rounded-circle" src="{{$user->avatar}}">
                            @else
                                <span class="avatar avatar-128 rounded-circle bg-primary my-auto">{{$user->initials}}</span>
                            @endif
                            <br>
                        <span class="h4 text-primary fw-bold mt-2">{{ $user->name }}</span> <br>
                        <span class="small">{{ $user->email }}</span>
                    </div>
                    @if (Auth::user()->id == $user->id)
                        <button class="btn btn-primary w-100" type="button" data-bs-toggle="modal"
                            data-bs-target="#select_post_type">
                            @lang('icon', ['s' => 20, 'i' => 'pencil'])
                            @lang('profile.posts.publish')
                        </button>
                        <button class="btn btn-primary d-lg-none w-100" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#settings" aria-controls="settings">
                            @lang('icon', ['s' => 20, 'i' => 'settings'])
                            @lang('settings')
                        </button>
                    @endif
                </div>
            </div>

            @if (Auth::user()->id == $user->id)
                <div class="modal fade" id="select_post_type" tabindex="-1" aria-labelledby="select_post_typeLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex gap-3">
                                    <div class="card w-100 h-100" data-bs-toggle="modal" data-bs-target="#post_publish">
                                        <div class="card-body text-center">
                                            @lang('icon', ['s' => 120, 'i' => 'align-box-left-bottom']) <br>
                                            @lang('profile.posts.post')
                                        </div>
                                    </div>
                                    <a class="text-decoration-none card w-100 h-100" href="{{ route('books.exchange') }}">
                                        <div class="card-body text-center">
                                            @lang('icon', ['s' => 120, 'i' => 'arrows-exchange']) <br>
                                            @lang('m.book-exchange')
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="post_publish" tabindex="-1" aria-labelledby="post_publishLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{route('posts.publish')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <nav class="card-body p-2 d-flex flex-nowrap overflow-x-auto gap-2"
                                            id="postImagePreview">
                                        </nav>
                                        <input type="file" name="images[]" id="images"
                                            class="form-control form-control-sm" multiple accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="body" id="posts" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <button type="reset"
                                            class="btn bg-body-secondary border w-100">@lang('reset')</button>
                                        <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                                    </div>
                                </form>
                                <script>
                                    $('#images').on('change', function() {
                                        let files = this.files;
                                        $('#imagePreview').empty();

                                        Array.from(files).forEach((file, index) => {
                                            let reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#postImagePreview').append(`
                                                    <div class="image-container p-0 rounded" data-index="${index}">
                                                            <img сlass="rounded" style="height: 200px;object-fit: contain;width: auto;" src="${e.target.result}">
                                                            <button type="button" class="btn btn-danger remove-image">Remove</button>
                                                    </div>
                                                `);
                                            };
                                            reader.readAsDataURL(file);
                                        });
                                    });

                                    // Remove selected image
                                    $(document).on('click', '.remove-image', function() {
                                        $(this).closest('.image-container').remove();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="books_exchange" tabindex="-1" aria-labelledby="books_exchangeLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="settings" aria-labelledby="settingsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="settingsLabel">@lang('icon', ['s' => 20, 'i' => 'settings'])
                            @lang('settings')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#settings"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pt-3">
                        <div class="card w-100 border-0">
                            <div class="card-body">
                                <div class="btn-group-vertical mb-2 w-100">
                                    <button class="btn text-start bg-body-secondary w-100 border" data-bs-toggle="modal"
                                    data-bs-target="#peModal">
                                        @lang('icon', ['s' => 20, 'i' => 'pencil'])
                                        @lang('settings.profile.edit')
                                    </button>
                                    <button class="btn text-start bg-body-secondary w-100 border" data-bs-toggle="modal"
                                        data-bs-target="#passwordModal">
                                        @lang('icon', ['s' => 20, 'i' => 'password-user'])
                                        @lang('settings.profile.password_update')
                                    </button>
                                </div>
                                <button class="btn btn-danger text-start w-100">
                                    @lang('icon', ['s' => 20, 'i' => 'user-cancel'])
                                    @lang('settings.profile.delete_acc')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="peModal" tabindex="-1" aria-labelledby="peModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="peModalLabel">@lang('settings.profile.avatar_upd')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.profile.a_upd') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="avatar" id="" class="form-control">
                                    <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">@lang('settings.profile.password_update')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.profile.pwd_upd') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">@lang('current_password')</label>
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">@lang('new_password')</label>
                                        <input type="password" class="form-control" id="new_password"
                                            name="new_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password_confirmation"
                                            class="form-label">@lang('new_password_confirm')</label>
                                        <input type="password" class="form-control" id="new_password_confirmation"
                                            name="new_password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">@lang('submit')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-9">
            <div class="card border-0 mb-2">
                <ul class="card-body p-2 d-flex flex-nowrap overflow-x-auto gap-2 nav nav-pills" id="pills-tab"
                    role="tablist">
                    <li class="nav-item d-flex" role="presentation">
                        <a href="#posts" class="nav-link active" id="pills-posts-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-posts" type="button" role="tab" aria-controls="pills-posts"
                            aria-selected="true">
                            @lang('profile.posts')
                        </a>
                    </li>
                    <li class="nav-item d-flex" role="presentation">
                        <a href="#clubs" class="nav-link" id="pills-clubs-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-clubs" type="button" role="tab" aria-controls="pills-clubs"
                            aria-selected="false">
                            @lang('profile.clubs')
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-posts" role="tabpanel"
                    aria-labelledby="pills-posts-tab" tabindex="0">
                    @foreach ($user->posts as $post)
                        <div class="mb-2">
                            <x-ui.post-card :id="$post->id" />
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="pills-clubs" role="tabpanel" aria-labelledby="pills-clubs-tab"
                    tabindex="0">...</div>
            </div>
        </div>
    </div>
@endsection
