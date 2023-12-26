@extends('layouts.app')

@section('title', 'Recommendation')
@section('content')
    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-md-3">
                @include('include.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card border-0 rounded-30 shadow">
                    <div class="card-body my-3">
                        <h3 class="fw-bold text-teal">Accomodation Recommendation</h3>
                        <hr>
                        <form method="GET" action="{{ route('recommendations.search') }}">
                            @csrf
                            <input type="hidden" name="key" value="{{ null }}">
                            <button class="btn btn-hijau rounded-pill">Create new
                                Recommendation</button>
                        </form>
                        @foreach ($recommendations as $recommendation)
                            <div class="card rounded-30 my-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-9 my-3">
                                            <h4 class="text-teal fw-bold">{{ $recommendation->accomodation->name }}</h4>
                                            <p class="text-muted">{{ $recommendation->accomodation->address }} |
                                                {{ $recommendation->accomodation->city->name }},
                                                {{ $recommendation->accomodation->city->country }}</p>
                                            <p>Comment: {{ $recommendation->comment }}</p>
                                        </div>
                                        <div class="col-md-3 my-3">
                                            <a href="{{ route('recommendations.delete', $recommendation) }}"
                                                class="btn btn-danger rounded-pill px-4">Delete</a>
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
