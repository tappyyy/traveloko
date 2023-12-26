@extends('layouts.app')


@section('title', 'Checkout Transaction')
@section('content')
<div class="container py-5 mb-5">
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    <input type="hidden" name="day" value="{{ $day }}">

    <div class="card border-0 shadow rounded-30 mt-3">
        <div class="card-body my-3">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img class="rounded" src="/storage/images/{{ $booking->room->photo }}" width="100%" alt="">
                </div>
                <div class="col-md-9">
                    <h3 class="fw-bold text-teal">{{ $booking->room->type }} -
                        {{ $booking->room->accomodation->name }}</h3>
                    <p class="text-muted mb-1">{{ $booking->room->accomodation->address }} |
                        {{ $booking->room->accomodation->city->name }},
                        {{ $booking->room->accomodation->city->country }} <br>
                        {{ $booking->room->description }}</p>
                    <p>Check-in: {{ date('d F Y', strtotime($booking->check_in)) }} |
                        Check-out: {{ date('d F Y', strtotime($booking->check_out)) }}</p>
                </div>
            </div>
            <hr>
            <div class="row align-items-center">
                <div class="col-md-6 my-2">
                    <p>Reserved Room Quantity: <input type="text" class="border-0" readonly
                            value="{{ $booking->quantity }}" name="quantity">
                        <br>Price per Night: Rp{{ number_format($booking->room->price) }}
                        <br>Health Protocol Fee:
                        Rp{{ number_format($booking->room->accomodation->health_protocol_fee) }}
                        @php
                        $addtiion=0;
                        @endphp
                        @if($booking->packet!=NULL)
                        <br>Additional Relaxation Package:
                        @if($booking->packet==1)
                        Rp109,999
                        @php
                        $addition=109999;
                        @endphp
                        @endif
                        @if($booking->packet==2)
                        Rp139,999
                        @php
                        $addition=139999;
                        @endphp
                        @endif
                        @if($booking->packet==3)
                        Rp159,999
                        @php
                        $addition=159999;
                        @endphp
                        @endif

                        @endif
                        <br>Total Day: {{ $day }}
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-end my-2 text-end">
                    Total Room Price: Rp{{ number_format($booking->room->price * $booking->quantity * $day) }} <br>
                    Total Health Protocol Fee:
                    @if($booking->packet!=NULL)
                    Rp{{ number_format($booking->room->accomodation->health_protocol_fee * $booking->quantity +
                    $addition)}}
                    @else
                    Rp{{ number_format($booking->room->accomodation->health_protocol_fee * $booking->quantity)}}
                    @endif
                    <br> <br>
                </div>
                <div class="col-md-15 d-flex justify-content-end my-2 text-end"
                    style="color:#1BA0E2; font-weight: 600;">
                    Total Price:
                    @if($booking->packet!=NULL)
                    Rp{{ number_format($booking->room->price * $booking->quantity * $day +
                    $booking->room->accomodation->health_protocol_fee * $booking->quantity + $addition) }}
                    @else
                    Rp{{ number_format($booking->room->price * $booking->quantity * $day +
                    $booking->room->accomodation->health_protocol_fee * $booking->quantity) }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5 fw-bold text-teal">Select payment method</h3>
    <hr>
    <div class="accordion mt-3" id="accordionExample">
        <div class="accordion-item shadow">
            <h2 class="accordion-header panel-heading" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    With Bank Transfer
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body my-4 px-5">
                    <form action="{{ route('checkouts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="day" value="{{ $day }}">
                        <input type="hidden" name="payment_type" value="BNK">
                        <p>Total Payment:
                            @if($booking->packet!=NULL)
                            Rp{{ number_format($booking->room->price * $booking->quantity * $day +
                            $booking->room->accomodation->health_protocol_fee * $booking->quantity +$addition) }}
                            @else
                            Rp{{ number_format($booking->room->price * $booking->quantity * $day +
                            $booking->room->accomodation->health_protocol_fee * $booking->quantity)}}
                            @endif
                        </p>
                        @if($booking->packet!=NULL)
                        <input type="hidden" name="addition" value="{{ $addition }}">
                        @else
                        <input type="hidden" name="addition" value="0">
                        @endif
                        <p>Please transfer to: 3892478923xxxx a/n Brian</p>
                        <hr>
                        <label for="transfer_proof">Upload your transfer proof
                            <br>
                            <small class="text-muted">Format: PNG,JPG,JPEG Max: 1MB</small>
                        </label>
                        <input type="file" class="form-control rounded-pill mt-3" name="transfer_proof">

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-hijau rounded-pill px-4">Create checkout with Bank
                                Transfer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item shadow">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Cut Your Balance
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body my-3 px-5">
                    <form action="{{ route('checkouts.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="day" value="{{ $day }}">
                        <input type="hidden" name="payment_type" value="BAL">
                        @if($booking->packet!=NULL)
                        <input type="hidden" name="addition" value="{{ $addition }}">
                        @else
                        <input type="hidden" name="addition" value="0">
                        @endif
                        <p>Your Balance: Rp{{ auth()->user()->balance }}</p>
                        <p>Total Payment:
                            @if($booking->packet!=NULL)
                            Rp{{ number_format($booking->room->price * $booking->quantity * $day +
                            $booking->room->accomodation->health_protocol_fee * $booking->quantity + $addition)}}
                            @else
                            Rp{{ number_format($booking->room->price * $booking->quantity * $day +
                            $booking->room->accomodation->health_protocol_fee * $booking->quantity )}}
                            @endif


                        </p>
                        <div class="d-flex justify-content-end">
                            @if($booking->packet!=NULL)
                            @if (auth()->user()->balance < $booking->room->price * $booking->quantity * $day +
                                $booking->room->accomodation->health_protocol_fee * $booking->quantity + $addition)
                                <h5 class="fw-bold text-danger">Not enough balance</h5>
                                @else
                                <button type="submit" class="btn btn-hijau px-4 rounded-pill">Checkout with your
                                    balance</button>
                                @endif
                                @else
                                @if (auth()->user()->balance < $booking->room->price * $booking->quantity * $day +
                                    $booking->room->accomodation->health_protocol_fee * $booking->quantity)
                                    <h5 class="fw-bold text-danger">Not enough balance</h5>
                                    @else
                                    <button type="submit" class="btn btn-hijau px-4 rounded-pill">Checkout with your
                                        balance</button>
                                    @endif
                                    @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection