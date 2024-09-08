@extends('layouts.app')

@section('content')
<div class="d-flex w-100">
    <div class="card mx-auto">
        <div class="card-body text-center">
            <h1>@lang('game.result')</h1>
            <span class="text-primary display-1 fw-bold">{{ $game->score }}</span> <br>
            <a href="{{ route('game.create', ['gameType' => $game->game_type]) }}" class="btn btn-primary w-100 mb-2">@lang('restart')</a> <br>
            <a href="{{ route('home') }}" class="btn btn-outline-primary w-100">@lang('m.home')</a>
        </div>
    </div>
</div>
@endsection
