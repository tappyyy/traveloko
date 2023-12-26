@extends('layouts.app')
@section('title', 'Accomodation Search - Traveloko')
@section('content')
<div class="container py-5 mb-5">

    <div class="header-accomodation">
        <div class="d-flex justify-content-between">
            @if ($_GET['place'] != null && $city != null)
            <h1>Search result: <span class="fw-bold text-teal">{{ $_GET['place'] }}, {{ $city->name }},
                    {{ $city->country }}</span>
            </h1>
            @elseif ($_GET['place'] != null)
            <h1>Search result: <span class="fw-bold text-teal">{{ $_GET['place'] }}</span>
            </h1>
            @elseif($city != null)
            <h1>Accomodation in <span class="fw-bold text-teal">{{ $city->name }},
                    {{ $city->country }}</span>
            </h1>
            @endif
            @if ($city != null)
            <div class="d-flex fs-6 zone-wrap" data-toggle="tooltip" data-placement="bottom"
                title="🟢 Safe&#013;🟡 Warning&#013;🟠 Risk&#013;🔴 Danger&#013;⚫ Hazard">
                <h1 class="d-flex align-items-center">
                    Zone:&nbsp;<span id="zone-color"></span>
                </h1>
            </div>
            <input type="hidden" id="province" value="{{ $city->province }}">
            @endif
        </div>
        <div class="d-flex justify-content-between mt-3">
            <p class="m-0">{{ $_GET['qty'] }} Rooms - {{ count($accomodations) }} accomodations found</p>
            <p class="m-0 text-muted">Check-in : {{ date('d F Y', $check_in) }} - Check-out:
                {{ date('d F Y', $check_out) }}</p>
        </div>
    </div>

    <hr>
    @foreach ($accomodations as $accomodation)
    <div class="card border-0 shadow rounded-30 my-3 mb-4 ">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-2 my-3">
                    <img class="rounded-30" src="/storage/images/{{ $accomodation->photo }}" width="100%" alt="">
                </div>
                <div class="col-md-7 my-3">
                    <h6 class="text-muted">{{ $accomodation->category->category_name }}</h6>
                    <h3 class="fw-bold text-teal">{{ $accomodation->name }}</h3>
                    <p class="text-muted">{{ $accomodation->address }}, {{ $accomodation->city->name }},
                        {{ $accomodation->city->country }}
                    </p>

                </div>
                <div class="col-md-3 text-end my-3">
                    <h4 class="fw-bold">Rp
                        {{ number_format($accomodation->cheaperRoom->price) }}</h4>
                    <a class="btn btn-hijau btn-lg rounded-pill px-4 mt-3"
                        href="{{ route('rooms.index', ['qty' => $_GET['qty'], 'accomodation_id' => $accomodation->id, 'check_in' => $check_in, 'check_out' => $check_out, 'place' => $_GET['place']]) }}">Choose
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
$(document).ready(function() {
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
            document.getElementById("zone-color").style.backgroundColor = color[i];
        }
    }
}
</script>
@endsection