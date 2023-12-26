@extends('layouts.app')

@section('title', 'Bookings - Traveloko')
@section('content')
<div class="container py-5 mb-5">
    <a class="btn btn-hijau btn-lg rounded-pill"
        href="{{ route('rooms.index', ['qty' => $qty, 'accomodation_id' => $room->accomodation->id, 'check_in' => strtotime($check_in), 'check_out' => strtotime($check_out), 'place' => $_GET['place']]) }}">Back
        to rooms</a>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="room_id" value="{{ $_GET['room_id'] }}">
        <input type="hidden" name="check_in" value="{{ $_GET['check_in'] }}">
        <input type="hidden" name="check_out" value="{{ $_GET['check_out'] }}">

        <div class="card border-0 shadow rounded-30 mt-3">
            <div class="card-body my-3">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img class="rounded" src="/storage/images/{{ $room->photo }}" width="100%" alt="">
                    </div>
                    <div class="col-md-9">
                        <h3 class="fw-bold text-teal">{{ $room->type }} - {{ $room->accomodation->name }}</h3>
                        <p class="text-muted mb-1">{{ $room->accomodation->address }} |
                            {{ $room->accomodation->city->name }},
                            {{ $room->accomodation->city->country }} <br>
                            {{ $room->description }}</p>
                        <p>Check-in: {{ date('d F Y', strtotime($_GET['check_in'])) }} |
                            Check-out: {{ date('d F Y', strtotime($_GET['check_out'])) }}</p>
                    </div>
                </div>
                <hr>
                <div class="row align-items-end">
                    <div class="col-md-10 my-2">
                        <p>Reserved Room Quantity: <input type="text" class="border-0" readonly
                                value="{{ $_GET['qty'] }}" name="quantity">
                            <br>Price per Night: Rp{{ number_format($room->price) }}
                            <br>Health Protocol Fee: Rp{{ number_format($room->accomodation->health_protocol_fee) }}
                            per room
                        </p>
                        <p>Relaxation Package:
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="packet" id="flexRadioDefault1" value="1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Relaxation Package A (Tranquil Retreat): Rp109,999<br>• Aromatherapy Candle<br>
                                • Lavender Eye Mask<br>
                                • Relaxing Essential Oil Blend <br><br>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="packet" id="flexRadioDefault1" value="2">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Relaxation Package B (Serene Escape): Rp139,999<br>• Aromatherapy Candle<br>
                                • Lavender Eye Mask<br>
                                • Relaxing Essential Oil Blend <br>• Cozy Blanket <br><br>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="packet" id="flexRadioDefault1" value="3">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Relaxation Package C (Ultimate Relaxation): Rp159,999<br>• Aromatherapy Candle<br>
                                • Lavender Eye Mask<br>
                                • Relaxing Essential Oil Blend <br>• Cozy Blanket <br>• Spa-quality Bath Salts<br><br>
                            </label>
                        </div>
                        </p>
                    </div>
                    <div class="col-md-2 my-2">
                        @if (auth()->user()->role != 'USER')
                        <label for="user_id">User ID:</label>
                        <input type="number" class="form-control rounded-pill" name="user_id" style="width: 150px;">
                        @endif
                        <button type="submit" class="btn btn-hijau btn-lg rounded-pill px-4 mt-3">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection