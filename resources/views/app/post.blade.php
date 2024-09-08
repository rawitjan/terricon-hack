@extends('layouts.app')

@section('content')
@if ($id)
<div class="row g-3">
    <div class="col-sm-6"><x-ui.post-card :id="$id" /></div>
    <div class="col-sm-6 overflow-y-auto">
        <div class="d-flex flex-column gap-2" style="height: 87dvh">
            @foreach ($post->comments as $comment)
                <x-ui.comment :id="$comment->id"/>
            @endforeach
            <div class="card sticky-bottom">
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="d-flex gap-3">
                            <textarea name="comment" id="" cols="30" rows="2" class="form-control"></textarea>
                            <button class="btn ms-auto btn-primary">@lang('icon', ['s' => 20, 'i' => 'send-2'])</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="d-flex h-100">
        <div class="card m-auto">
            <div class="card-body">
                @lang('icon', ['s' => 20, 'i' => '404']) <br>
                @lang('404')
            </div>
        </div>
    </div>
@endif
@endsection
