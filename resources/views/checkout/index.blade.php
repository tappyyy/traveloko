@extends('layouts.app')

@section('title', 'My Checkouts')
@section('content')
    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-md-3">
                @include('include.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card border-0 rounded-30 shadow">
                    <div class="card-body my-3">
                        <h3 class="fw-bold text-teal">My Checkouts</h3>
                        <hr>
                        @foreach ($checkouts as $checkout)
                            <div class="card my-2 rounded-30">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <img width="100%" src="/storage/images/{{ $checkout->booking->room->photo }}"
                                                alt="">
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="fw-bold text-teal">{{ $checkout->booking->room->type }} -
                                                {{ $checkout->booking->room->accomodation->name }}
                                            </h3>
                                            <p class="text-dark m-0">
                                                {{ $checkout->booking->room->accomodation->address }},
                                                {{ $checkout->booking->room->accomodation->city->name }},
                                                {{ $checkout->booking->room->accomodation->city->country }}</p>
                                            <small>{{ $checkout->booking->quantity }} Rooms |
                                                Check-in: {{ date('d F Y', strtotime($checkout->booking->check_in)) }} |
                                                Check-out: {{ date('d F Y', strtotime($checkout->booking->check_out)) }}
                                                <br>
                                                Grand Total: Rp {{ number_format($checkout->total_payment) }} <br>
                                                <small class="text-muted">Transaction time:
                                                    {{ date('d F Y H:i', strtotime($checkout->created_at)) }}</small>
                                            </small>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            @if ($checkout->is_success == 1)
                                                <h5 class="text-success fw-bold">Success</h5>
                                            @elseif($checkout->is_success == 0)
                                                <h5 class="text-warning fw-bold">Pending</h5>
                                            @else
                                                <h5 class="text-danger fw-bold">Failed</h5>
                                            @endif

                                            @if ($checkout->rating == 1)
                                                <hr>
                                                <h6 class="text-success">(Rated)</h6>
                                            @elseif($checkout->is_success == 1)
                                                <hr>
                                                <a href="{{ route('ratings.index', $checkout->id) }}"
                                                    class="btn btn-hijau rounded-pill">Give Rating</a>
                                            @endif
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
