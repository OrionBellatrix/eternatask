@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 80vh; margin: 0;">
        <img src="{{ asset('images/eterna-darklogo.webp') }}" alt="Login" style="width: 200px" class="mb-3">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">{{ __('Üye Ol') }}</h5>

                @include('layouts.alert')
                <!-- Login Form -->
                <form action="{{ route('register') }}" method="POST" accept-charset="UTF-8">
                    @csrf
                    <div class="mb-3">
                        <label for="firstname" class="form-label">{{ __('Adınız') }}</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">{{ __('Soyadınız') }}</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">{{ __('Kullanıcı Adı') }}</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('E-mail Adresiniz') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Şifre') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password-confirmation" class="form-label">{{ __('Şifre Tekrarı') }}</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">{{ __('Üye Ol') }}</button>
                </form>
                <div class="mt-3 text-center">
                    <p>Zaten üye misin?? <a href="{{ route('login') }}" class="btn btn-link p-0">{{ __('Giriş Yap') }}</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
