@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                @include('include.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card border-0 rounded-30 shadow">
                    <div class="card-body my-3">
                        <h3 class="fw-bold text-teal">Update Profile</h3>
                        <hr>
                        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="my-3">
                                <label for="name" class="form-label">Name: </label>
                                <input type="text" class="form-control rounded-pill" id="name" name="name"
                                    value="{{ $profile->name }}">
                            </div>
                            <div class="my-3">
                                <label for="email" class="form-label">Email: </label>
                                <input type="email" class="form-control rounded-pill" id="email" name="email"
                                    value="{{ $profile->email }}">
                            </div>
                            <div class="my-3">
                                <label for="phone" class="form-label">Phone Number: </label>
                                <input type="text" class="form-control rounded-pill" id="phone" name="phone"
                                    value="{{ $profile->phone_number }}">
                            </div>
                            <hr>
                            <div class="my-3">
                                <label for="password" class="form-label">Change Password</label>
                                <input type="password" class="form-control rounded-pill" id="password" name="password">
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-hijau rounded-pill px-4">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
