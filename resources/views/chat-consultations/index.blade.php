@extends('layouts.app')

@section('title', 'Chat Consultations - NginepKuy')
@section('content')
    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-md-3">
                @include('include.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow rounded-30">
                    <div class="card-body my-3">
                        <h3 class="fw-bold text-teal">Your Consultations</h3>
                        <p class="text-muted">Start your consultation by our travel agents</p>
                        <hr>
                        @foreach ($consultations as $consultation)
                            <div class="card rounded-30 my-2">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-9 my-3">
                                            <h3 class="fw-bold text-teal">
                                                @if (auth()->user()->id == $consultation->user_id)
                                                    {{ $consultation->ota->name }} - {{ $consultation->ota->ota_name }}
                                                @else
                                                    {{ $consultation->user->name }} - ID: {{ $consultation->user->id }}
                                                @endif
                                            </h3>
                                            @if ($consultation->is_eligible == 0)
                                                <p class="text-pending m-0">Waiting for confirmation</p>
                                            @elseif($consultation->is_eligible == 1)
                                                <p class="text-success m-0">Eligible</p>
                                            @else
                                                <p class="text-danger m-0">Not Eligible</p>
                                            @endif
                                            <p class="m-0">
                                                @if ($consultation->start_time == null)
                                                    Please choose "Start" button to start your consultation
                                                @else
                                                    Finished at {{ $consultation->end_time }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-3 my-3 text-center">
                                            @if ($consultation->start_time != null && strtotime($consultation->end_time) <= time())
                                                <p class="fw-bold text-danger">Consultation has been ended</p>
                                            @else
                                                <a href="{{ route('chat-consultations.show', $consultation) }}"
                                                    class="btn btn-hijau rounded-pill px-4">Start Consultation</a>
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
