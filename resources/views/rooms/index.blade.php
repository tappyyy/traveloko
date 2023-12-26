@extends('layouts.app')
@section('title', 'Rooms - NginepKuy')
@section('content')
<div class="container py-5 mb-5">
    <a class="btn btn-hijau btn-lg rounded-pill"
        href="{{ route('accomodations.index', ['qty' => $qty, 'city_id' => $accomodation->city->id, 'check_in' => $check_in, 'check_out' => $check_out, 'place' => $_GET['place']]) }}">Back
        to accomodations</a>

    <div class="d-flex justify-content-end">
        <p class="m-0 text-muted">{{ $_GET['qty'] }} Rooms | Check-in : {{ date('d F Y', $_GET['check_in']) }} |
            Check-out:
            {{ date('d F Y', $_GET['check_out']) }}</p>
    </div>
    <div class="card border-0 shadow rounded-30 mt-3">
        <div class="card-body my-3">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img class="rounded-30" src="/storage/images/{{ $accomodation->photo }}" width="100%" alt="">
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted">{{ $accomodation->category->category_name }}</h6>
                    <h3 class="text-teal fw-bold">{{ $accomodation->name }}</h3>
                    <div class="d-flex room-zone">
                        <input type="hidden" id="province" value="{{ $accomodation->city->province }}">
                        <p class="text-muted">{{ $accomodation->address }}, {{ $accomodation->city->name }},
                            {{ $accomodation->city->country }}
                        </p>
                        <p data-toggle="tooltip" data-placement="bottom"
                            title="🟢 Safe&#013;🟡 Warning&#013;🟠 Risk&#013;🔴 Danger&#013;⚫ Hazard">&nbsp;<span
                                id="zone-color"></span></p>
                    </div>
                    <p>{{ optional($recommendation)->total }} recommendations from Travel Agent</p>
                </div>
                <div class="col-md-2 d-flex justify-content-center">
                    <h4>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($ratings as $rating)
                        @php
                        $total += $rating->star;
                        @endphp
                        @endforeach
                        @php
                        if ($ratings->count() != 0) {
                        echo $total / $ratings->count() . '/5';
                        } else {
                        echo '4.9';
                        }
                        @endphp
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <h2 class="fw-bold text-teal mt-5">Available Rooms</h2>
    <hr>
    @foreach ($rooms as $room)
    <div class="card border-0 shadow rounded-30 my-2 mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 my-3">
                    <img class="rounded-30" src="/storage/images/{{ $room->photo }}" width="100%" alt="">
                </div>
                <div class="col-md-6 my-3">
                    <h6 class="text-muted">{{ $accomodation->name }}</h6>
                    <h3 class="text-teal fw-bold">{{ $room->type }}</h3>
                    <p class="text-muted">{{ $room->description }}</p>
                    <h5><span class="text-dark fw-bold">Rp{{ number_format($room->price) }}</span> <small>per
                            Night</small>
                    </h5>
                </div>
                <div class="col-md-3 my-3 d-flex justify-content-center">
                    <a class="btn btn-hijau btn-lg rounded-pill px-4"
                        href="{{ route('bookings.create', ['qty' => $qty, 'room_id' => $room->id, 'check_in' => $check_in, 'check_out' => $check_out, 'place' => $_GET['place']]) }}">Book
                        This Room</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <h2 class="fw-bold text-teal mt-5">User Reviews</h2>
    <hr>
    @foreach ($accomodation->rating as $rating)
    <div class="card border-0 shadow rounded-30 my-2 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center ">
                    <div style="width:100px;height:100px;border-radius:50%;background:black"></div>
                    <div class="d-block ms-4">
                        <h5 class="text-teal fw-bold">{{ $rating->user->name }}</h5>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-star text-warning me-2" aria-hidden="true"></i> {{ $rating->star }}/5
                        </div>
                        <p>{{ $rating->comment }}</p>
                    </div>
                </div>
                <h6 class="px-2 text-muted">{{ date('d F Y H:i', strtotime($rating->created_at)) }}</h6>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    var provinsiName = [""];
    var kasusPositif = 0;
    var color = [""];

    const Http = new XMLHttpRequest();
    const url = 'https://indonesia-covid-19.mathdro.id/api/provinsi';
    Http.open('GET', url);
    Http.send();
    Http.onreadystatechange = () => {
        if (Http.readyState == 4 && Http.status == 200) {
            var coronaData = JSON.parse(Http.responseText);
            for (var i = 0; i < coronaData.data.length; i++) {
                provinsiName[i] = coronaData.data[i].provinsi;
                kasusPositif = parseInt(coronaData.data[i].kasusPosi);
                if (kasusPositif < 12099) {
                    color[i] = "green"
                } else if (kasusPositif >= 12099 && kasusPositif < 24198) {
                    color[i] = "yellow"
                } else if (kasusPositif >= 24198 && kasusPositif < 36297) {
                    color[i] = "orange"
                } else if (kasusPositif >= 36297 && kasusPositif < 48396) {
                    color[i] = "red"
                } else {
                    color[i] = "black"
                }
            }
        }
        for (let i = 0; i < provinsiName.length; i++) {
            if (document.getElementById("province").value == provinsiName[i]) {
                console.log(provinsiName[i]);
                document.getElementById("zone-color").style.backgroundColor = color[i];
            }
        }
    }
</script>
@endsection