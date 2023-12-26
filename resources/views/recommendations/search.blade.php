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
                        <form action="{{ route('recommendations.search') }}" method="GET">
                            @csrf
                            <div class="d-flex">
                                <input type="text" value="{{ $key ? $key : '' }}" name="key"
                                    class="form-control rounded-pill">
                                <button class="btn btn-hijau rounded-pill ms-2 px-4">Search</button>
                            </div>
                        </form>
                        <hr>
                        @if (count($accomodations) > 0)
                            @foreach ($accomodations as $accomodation)
                                <div class="card rounded-30 my-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9 my-3">
                                                <h4 class="text-teal fw-bold">{{ $accomodation->name }}</h4>
                                                <p class="text-muted">{{ $accomodation->address }} |
                                                    {{ $accomodation->city->name }},
                                                    {{ $accomodation->country }}</p>
                                                <hr>
                                                <form action="{{ route('recommendations.store') }}" method="POST">
                                                    @csrf
                                                    Submit Recommendation
                                                    <input type="hidden" value="{{ $accomodation->id }}"
                                                        name="accomodation_id">
                                                    <input type="text" class="form-control rounded-pill my-2"
                                                        placeholder="Type your comment" name="comment">
                                                    <button type="submit" class="btn btn-hijau rounded-pill">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Not found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
