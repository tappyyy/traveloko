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
                        <h3 class="text-teal fw-bold">Checkout Confirmation</h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tr class="bg-dark text-white">
                                    <th>Booking ID</th>
                                    <th>User</th>
                                    <th>Total Payment</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($checkouts as $checkout)
                                    <tr>
                                        <td>{{ $checkout->booking_id }}</td>
                                        <td>{{ $checkout->user->name }}</td>
                                        <td>Rp{{ $checkout->total_payment }}</td>
                                        <td>
                                            <a href="/storage/proof/{{ $checkout->transfer_proof }}"
                                                class="btn btn-primary">Proof</a>
                                            <a href="{{ route('admin.accept', $checkout->id) }}"
                                                class="btn btn-hijau">Accept</a>
                                            <a href="{{ route('admin.decline', $checkout->id) }}"
                                                class="btn btn-danger">Decline</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <h3 class="text-teal fw-bold mt-4">Consultation Confirmation</h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <tr class="bg-dark text-white">
                                    <th>User Name</th>
                                    <th>OTA Name</th>
                                    <th>Total Payment</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($otas as $ota)
                                    <tr>
                                        <td>{{ $ota->user->name }}</td>
                                        <td>{{ $ota->ota->name }}</td>
                                        <td>Rp{{ $ota->price }}</td>
                                        <td>
                                            <a href="/storage/proof/{{ $ota->transfer_proof }}"
                                                class="btn btn-primary">Proof</a>
                                            <a href="{{ route('ota.accept', $ota->id) }}"
                                                class="btn btn-hijau">Accept</a>
                                            <a href="{{ route('ota.decline', $ota->id) }}"
                                                class="btn btn-danger">Decline</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
