<div class="card">
    <div class="card-header">
        <div class="d-flex gap-2">
            @if ($comment->author->avatar)
            <img class="avatar avatar-32 rounded-circle" src="{{$comment->author->avatar}}">
            @else
                <span class="avatar avatar-32 rounded-circle bg-primary my-auto">{{$comment->author->initials}}</span>
            @endif

            <div class="my-auto lh-1">
                <span class="h6">{{ $comment->author->name }}</span><br>
                <small class="text-muted">{{ $comment->updated_at }}</small>
            </div>
        </div>
    </div>
    <div class="card-body py-2">
        {{ $comment->body }}
        <div class="d-flex flex-column gap-2">
            @foreach ($comment->replyes as $reply)
                <x-ui.comment :id="$reply->id" :replying="false"/>
            @endforeach
        </div>

    </div>
    @if ($replying)
    <div class="card-footer">
        <form action="{{route('posts.comment.reply', ['id' => $comment->parent_id, 'comment_id' => $comment->id])}}" method="post">
            @csrf
            <div class="d-flex gap-3">
                <textarea name="comment" id="" cols="30" rows="1" class="form-control"></textarea>
                <button class="btn ms-auto btn-primary">@lang('icon', ['s' => 20, 'i' => 'send-2'])</button>
            </div>
        </form>
    </div>
    @endif
</div>
