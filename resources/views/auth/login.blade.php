@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 80vh; margin: 0;">
        <img src="{{ asset('images/eterna-darklogo.webp') }}" alt="Login" style="width: 200px" class="mb-3">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">{{ __('Giriş Yap') }}</h5>
                @include('layouts.alert')
                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" accept-charset="UTF-8">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Kullanıcı Adı veya E-mail') }}</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Şifre') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">{{ __('Giriş Yap') }}</button>
                </form>
                <div class="mt-3 text-center">
                    <p>Henüz üye değil misiniz? <a href="/register" class="btn btn-link p-0">Üye Ol</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
