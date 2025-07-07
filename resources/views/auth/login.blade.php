@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <style>
        body.login-page {
            background: linear-gradient(to bottom right, #fffbe6, #ffe066);
            color: #333;
        }

        .login-box {
            background-color: rgba(0, 0, 0, 0.75); /* box gelap transparan */
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
            padding: 20px;
            color: #f1f1f1;
        }

        .login-logo b {
            color: #f8f9fa;
            font-weight: 700;
            font-size: 28px;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #999;
            color: #fff;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .btn-primary {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(to bottom right, #fffde7, #ffe066);">
    <div class="row shadow-lg rounded overflow-hidden" style="max-width: 900px; width: 100%;">
        {{-- Kolom kiri: ilustrasi --}}
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-warning bg-gradient">
            <img src="{{ asset('images/login-illustration.svg') }}" alt="Ilustrasi" class="img-fluid p-4">
        </div>

        {{-- Kolom kanan: form login --}}
        <div class="col-md-6 bg-dark text-light p-5">
            <h3 class="mb-4 text-center">Selamat Datang di <strong>Mitra Prestasi</strong></h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control bg-light text-dark" required autofocus>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control bg-light text-dark" required>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold">Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('auth_header')
    <h1 class="text-center text-dark">Selamat Datang di <strong>Mitra Prestasi</strong></h1>
@endsection

@section('auth_footer')
    <p class="text-center text-dark">© {{ date('Y') }} Mitra Prestasi</p>
@endsection 

@section('auth_header', 'Selamat Datang di Mitra Prestasi')
@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <x-adminlte-input name="email" label="Email" type="email" placeholder="Email" required autofocus />
        <x-adminlte-input name="password" label="Password" type="password" placeholder="Password" required />

        <x-adminlte-button class="btn-block" type="submit" label="Masuk" theme="primary" />
    </form>
@endsection

@section('auth_footer')
    <p class="text-center text-light">© {{ date('Y') }} Mitra Prestasi</p>
@endsection
