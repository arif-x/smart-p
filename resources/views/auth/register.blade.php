@extends('layouts.auth')

@section('content')

<div class="page-content d-flex align-items-center justify-content-center">

    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pr-md-0">
                        <div class="auth-left-wrapper">

                        </div>
                    </div>
                    <div class="col-md-8 pl-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">MAT<span> PI</span></a>
                            <h5 class="text-muted font-weight-normal mb-4">Selamat Datang, Silakan Daftarkan Akun Anda.</h5>
                            <form class="forms-sample" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Daftar') }}
                                    </button>
                                    <a href="{{ route('first') }}" class="btn btn-primary">Kembali ke Halaman Awal</a>
                                    <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Sudah Menjadi User? Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
