@extends('layouts.auth')

@section('content')
<div class="card mx-auto">
    <div class="card-body">
        <div class="d-flex gap-2">
            <span class="h5 my-auto"></span>
            <span class="ms-auto my-auto"><x-ui.lang-switch/></span>
        </div>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">@lang('email')</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">@lang('password')</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password">
                @error('password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('rememberMe') }}
                    </label>
                </div>
            </div>
            <button class="btn btn-primary w-100 mb-2" type="submit">@lang('login')</button>
        </form>
        <a class="btn btn-secondary w-100" href="{{ route('register') }}">@lang('register')</a>
    </div>
</div>
@endsection
