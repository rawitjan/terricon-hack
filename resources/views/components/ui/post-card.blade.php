<div class="card @if ($post->user_id == Auth::user()->id) border-primary border-2 @endif">
    <div class="card-body p-0">
        <div class="d-flex flex-column p-3">
            @if ($post->club)
            <div class="d-flex gap-2">
                @if ($post->club->thumbnail)
                <img class="avatar avatar-48 rounded-circle" src="{{json_decode($post->club->thumbnail)}}">
                @else
                    <span class="avatar avatar-48 rounded-circle bg-primary my-auto">{{$post->author->initials}}</span>
                @endif

                <div class="my-auto lh-1">
                    <span class="h5 fw-bold ">{{ $post->club->title }}</span><br>
                    <small class="text-muted">{{ $post->updated_at }}</small>
                </div>
            </div>
            @else
                <div class="d-flex gap-2">
                    @if ($post->author->avatar)
                    <img class="avatar avatar-48 rounded-circle" src="{{$post->author->avatar}}">
                    @else
                        <span class="avatar avatar-48 rounded-circle bg-primary my-auto">{{$post->author->initials}}</span>
                    @endif

                    <div class="my-auto lh-1">
                        <span class="h5 fw-bold ">{{ $post->author->name }}</span><br>
                        <small class="text-muted">{{ $post->updated_at }}</small>
                    </div>
                </div>
            @endif
            <img src="{{ $post->thumbnail }}" alt="" class="w-100 img-fluid rounded">
            <div class="mb-3">
                @if ($post->type == 'books_exchange')
                    <ul class="list-group mb-3">
                        @foreach (json_decode($post->data) as $key => $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if ($key == 'type')
                                    <button class="btn btn-primary">@lang('post.be.type.' . $data)</button>
                                @else
                                    @lang('post.be.' . $key)
                                    <span class="">{{ $data }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if (isset(json_decode($post->assets)->imgs))
                    <nav class="card-body d-flex flex-nowrap overflow-x-auto gap-2">
                        @foreach (json_decode($post->assets)->imgs as $img)
                            <div class="image-container p-0 rounded">
                                <img сlass="rounded" style="height: 200px;object-fit: contain;width: auto;border-radius: 0.5rem;" src="{{$img}}">
                            </div>
                        @endforeach
                    </nav>
                @endif
                <span class="mt-2">{{ $post->body }}</span>
            </div>
        </div>
    </div>
    <a class="text-decoration-none card-footer" href="{{route('posts.get', ['id' => $post->id])}}">
        <div class="d-flex gap-2 w-100">
            @lang('icon', ['s' => 20, 'i' => 'message'])
            <span>{{ $post->comments->count() }}</span>
        </div>

        @if ($post->last_comments)
            <x-ui.comment :id="$post->last_comments->id" :replying="false"/>
        @endif
    </a>
</div>
