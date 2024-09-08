@extends('layouts.auth')

@section('content')
<div class="card mx-auto">
    <div class="card-body">
        <div class="d-flex gap-2">
            <span class="h5 my-auto"></span>
            <span class="ms-auto my-auto"><x-ui.lang-switch/></span>
        </div>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="row row-cols-1 row-cols-lg-2 g-2 mb-2">
                <div class="col">
                    <label for="name" class="form-label fw-medium">@lang('form.register.name')</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">@lang('form.register.email')</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
            <div class="mb-2">
                <label for="phone_number" class="form-label">@lang('form.register.phone_number')</label>
                <input type="tel" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror">
                @error('phone_number') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
            <div class="row row-cols-1 row-cols-lg-2 g-2 mb-2">
                <div class="col">
                    <label for="password" class="form-label">@lang('form.register.password')</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                    @error('password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
                <div class="col">
                    <label for="password-confirm" class="form-label">@lang('form.register.password-confirm')</label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control @error('phone_number') is-invalid @enderror" required autocomplete="new-password">
                </div>
            </div>
            <button class="btn btn-primary w-100" type="submit">
                {{ __('register') }}
            </button>
        </form>
    </div>
</div>
@endsection
