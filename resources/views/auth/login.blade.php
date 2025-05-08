@extends('layouts.app') {{-- eski hâline dönüyoruz --}}
@section('title', 'Giriş Yap') {{-- varsa title bölümü --}}

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid"> {{-- Metronic tam‑sayfa ortalama --}}
        <form method="POST" action="/login" class="form w-lg-500px p-10">
            @csrf
            <h1 class="mb-10">Panel Girişi</h1>

            {{-- Email --}}
            <div class="fv-row mb-8">
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus placeholder="E‑posta" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Şifre --}}
            <div class="fv-row mb-8">
                <input id="password" type="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required
                    placeholder="Şifre" />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Beni Hatırla + Şifremi Unuttum --}}
            <div class="d-flex flex-stack mb-5">
                <label class="form-check form-check-custom">
                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="form-check-label">Beni Hatırla</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-primary fw-semibold">
                        Şifremi Unuttum?
                    </a>
                @endif
            </div>

            {{-- Gönder --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Giriş Yap</button>
            </div>
        </form>
    </div>
@endsection
