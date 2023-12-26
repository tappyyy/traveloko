@extends('layouts.app')

@section('title', 'Travel Agent Consultation')
@section('content')
<div class="container my-5 pb-5">
    <div class="row">
        <div class="col-md-3">
            @include('include.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card border-0 shadow rounded-30">
                <div class="card-body my-3">
                    <h3 class="fw-bold" style="color:#1BA0E2">Travel Agent Consultation</h3>
                    <p class="text-muted">Select your travel agent | Consultation Duration: 1 hour | Price: Rp40.000</p>
                    <hr>
                    @foreach ($consultants as $consultant)
                    <div class="card rounded-30 my-2">
                        <div class="card-body my-3">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h3 class="text-teal fw-bold">{{ $consultant->name }}
                                    </h3>
                                    <p class="text-muted">{{ $consultant->ota_name }}</p>
                                </div>
                                <div class="col-md-3 d-flex justify-content-end align-items-start">
                                    <a href="{{ route('consultations.create', $consultant->id) }}"
                                        class="btn btn-hijau rounded-pill px-4">
                                        Choose this agent
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection