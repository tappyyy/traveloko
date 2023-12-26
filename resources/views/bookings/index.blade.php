@extends('layouts.app')

@section('title', 'Bookings - NginepKuy')
@section('content')
    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-md-3">
                @include('include.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow rounded-30">
                    <div class="card-body my-3 heading-booking">
                        <h3 class="fw-bold text-teal">My Bookings</h3>
                        <hr>
                        @foreach ($bookings as $booking)
                            <div class="card my-2 rounded-30">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <img width="100%" src="/storage/images/{{ $booking->room->photo }}" alt="">
                                        </div>
                                        <div class="col-md-7">
                                            <h3 class="fw-bold text-teal">{{ $booking->room->type }} -
                                                {{ $booking->room->accomodation->name }}
                                            </h3>
                                            <p class="text-dark">{{ $booking->room->accomodation->address }},
                                                {{ $booking->room->accomodation->city->name }},
                                                {{ $booking->room->accomodation->city->country }}</p>
                                            <p>{{ $booking->quantity }} Rooms |
                                                Check-in: {{ date('d F Y', strtotime($booking->check_in)) }} |
                                                Check-out: {{ date('d F Y', strtotime($booking->check_out)) }} <br>
                                                <small class="text-muted">Booked at
                                                    {{ date('d F Y H:i', strtotime($booking->created_at)) }}</small>
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            @if ($booking->checkout->id)
                                                <p class="text-success text-center">Already checkout</p>
                                            @else
                                                <a href="{{ route('checkouts.create', $booking) }}"
                                                    class="btn btn-hijau rounded-pill">Checkout</a>
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
