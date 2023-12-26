@extends('layouts.app')
@section('title', 'Register - NginepKuy')
@section('content')

    <div class="content-register">
        <div class="content-wrapper-register">
            <div class="profile-wrapper-register">
                <div class="profile-register">
                    <div class="pic-register">
                        <img src="/storage/assets/logo2.png" alt="" width="250px">
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow mt-3 detail-register">
                <div class="card-body my-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="register-itemsection">
                            <div>
                                <label for="firstName"><b>First Name :</b></label>
                                <p><input type="text" class="@error('name') is-invalid @enderror" name="name" id="firstName"
                                        placeholder="First Name"></p>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="lastName"><b>Last Name :</b></label>
                                <p><input type="text" name="lastName" id="lastName" placeholder="Last Name"></p>
                            </div>
                        </div>
                        <div class="register-itemsection">
                            <div>
                                <label for="email"><b>Email :</b></label>
                                <p><input type="email" class="@error('email') is-invalid @enderror" name="email" id="email"
                                        placeholder="Email"></p>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="phoneNumber"><b>Phone Number :</b></label>
                                <p><input type="tel" class="@error('phone') is-invalid @enderror" name="phone" id="phone"
                                        placeholder="Phone Number"></p>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="register-itemsection">
                            <div class="password-register">
                                <label for="password"><b>Password :</b></label>
                                <p><input type="password" class="@error('password') is-invalid @enderror" id="password"
                                        name="password" placeholder="Password"></p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="repassword-register">
                                <label for="repassword"><b>Re-Password :</b></label>
                                <p><input type="password" id="repassword" name="password_confirmation"
                                        placeholder="Re-Password"></p>
                            </div>
                        </div>
                        <div class="d-grid">
                            <p id="save" class="save-btn-register"><input type="submit" value="{{ __('Register') }}"
                                    class="button"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
