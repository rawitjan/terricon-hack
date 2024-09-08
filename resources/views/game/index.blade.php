@extends('layouts.app')

@section('content')
<div class="row g-3">
    <div class="col-sm">
        <a class="card text-decoration-none" href="{{route('game.create', ['gameType' => 'find_by_thumbnail'])}}">
            <div class="card-body">
                <div class="d-flex gap-3">
                    <div class="my-auto">
                        <span class="avatar avatar-64 bg-primary rounded-circle p-4">@lang('icon', ['s' => 20, 'i' => 'device-gamepad-2'])</span>
                    </div>
                    <div class="my-auto lh-1">
                        <span class="h4 fw-bold text-primary">@lang('gameType.find_by_thumbnail')</span><br>
                        <span class="small text-muted">@lang('gameType.find_by_thumbnail.info')</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm">
        <a class="card text-decoration-none" href="{{route('game.create', ['gameType' => 'find_by_description'])}}">
            <div class="card-body">
                <div class="d-flex gap-3">
                    <div class="my-auto">
                        <span class="avatar avatar-64 bg-primary rounded-circle p-4">@lang('icon', ['s' => 20, 'i' => 'device-gamepad-2'])</span>
                    </div>
                    <div class="my-auto lh-1">
                        <span class="h4 fw-bold text-primary">@lang('gameType.find_by_description')</span><br>
                        <span class="small text-muted">@lang('gameType.find_by_description.info')</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
