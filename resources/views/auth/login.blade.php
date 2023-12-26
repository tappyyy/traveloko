@extends('layouts.app')
@section('title', 'Login - NginepKuy')
@section('content')
    <div class="container my-5 py-5">
        <div class="row justify-content-center align-items-center mt-5 mb-5">
            <div class="col-md-5">
                <div class="logo-login" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-easing="ease-in-out">
                    <a href="#">
                        <img src="/storage/assets/logo1.png" alt="" width="300px">
                        <p>Your Safety is our Priority</p>
                    </a>
                </div>
            </div>
            <div class="col-md-5">
                <div class="content-wraper-login card border-0 shadow mt-3 " data-aos="zoom-in-left">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-form">
                            <div class="wraping-form">
                                <label for="username"><b>Email :</b></label>
                                <p>
                                    <input type="Email" class="@error('email') is-invalid @enderror" name="email" id="email"
                                        placeholder="Email">
                                </p>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="password"><b>Password :</b></label>
                                <p>
                                    <input type="password" class="@error('password') is-invalid @enderror" name="password"
                                        id="password" placeholder="Password">
                                </p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid">
                            <p id="save" class="save-btn-register"><input type="submit" value="{{ __('Login') }}"
                                    class="button" onclick="return validateLogin()"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
