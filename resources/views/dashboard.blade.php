@extends('layouts.app')

@section('title', 'Dashboard - Traveloko')
@section('content')
<div class="container my-5 pb-5">
    <div class="row">
        <div class="col-md-3">
            @include('include.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card border-0 rounded-30 shadow">
                <div class="card-body my-3">
                    <h3 class="fw-bold text-teal">Welcome to Traveloko</h3>
                    <hr>
                    <p>Your safety, our priority</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection