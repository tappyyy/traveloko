@extends('layouts.app')

@section('title', 'Chat Consultations - NginepKuy')
@section('content')
<meta http-equiv="refresh" content="10">
<div class="container my-5 pb-5">
    <div class="row">
        <div class="col-md-3">
            @include('include.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card border-0 rounded-30 shadow">
                <div class="card-body my-3">
                    <h3 class="fw-bold text-teal">Consultation -
                        {{ $consultation->user->id == auth()->user()->id ? $consultation->ota->name :
                        $consultation->user->name }}
                    </h3>
                    <hr>
                    <div class="card mt-2 mb-4" id="chatting-box"
                        style="width: 100%; height: 300px !important;overflow-y:scroll">
                        <div class="card-body">
                            <div class="text-center text-muted">-- Consultation started --</div>
                            @foreach ($chatConsultations as $chatConsultation)
                            <div
                                class="d-flex align-items-center
                                                                                                                                                                                                                                                                                  {{ $chatConsultation->sender_id == auth()->user()->id ? 'justify-content-end' : '' }} my-2">
                                <div class="{{ $chatConsultation->sender_id == auth()->user()->id ? 'order-2' : '' }}"
                                    style="border-radius:50%;width: 50px;height:50px;background:black"></div>
                                <div
                                    class="{{ $chatConsultation->sender_id == auth()->user()->id ? 'order-1 me-3' : 'ms-3' }}">
                                    <div
                                        class="{{ $chatConsultation->sender_id == auth()->user()->id ? 'text-end' : '' }}">
                                        <small>{{ $chatConsultation->sender->name }}</small>
                                    </div>
                                    <div class="py-2 px-3 rounded-pill"
                                        style="{{ $chatConsultation->sender_id == auth()->user()->id ? 'background: #1BA0E2;color:white' : 'border:1px solid #1BA0E2; color:black' }}">
                                        {{ $chatConsultation->message }}</div>
                                </div>
                                <small style="font-size:11px;" class="align-self-end text-muted mx-2">{{ date('H:i',
                                    strtotime($chatConsultation->created_at)) }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if (strtotime($consultation->end_time) <= time()) <p class="fw-bold text-danger">Consultation has
                        been ended</p>
                        @else
                        <form action="{{ route('chat-consultations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $consultation->id }}" name="consultation_id">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control rounded-pill" name="message" id="message"
                                        placeholder="Type your message here">
                                </div>
                                <div class="col-2">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-hijau">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var chatbox = document.getElementById("chatting-box");
    chatbox.scrollTop = chatbox.scrollHeight;

    // function update(){
    //     $("#chatting-box").load(window.location.href +" #chatting-box");
    // }

    // setInterval(update(),3000);
</script>
@endsection