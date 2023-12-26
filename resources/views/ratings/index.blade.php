@extends('layouts.app')

@section('title', 'Rating')
@section('content')

    <div class="container my-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6 my-3">
                <div class="card border-0 rounded-30 shadow">
                    <div class="card-body my-3">
                        <div class="row align-items-center">
                            <div class="col-md-5 my-3">
                                <img width="100%" class="rounded-30"
                                    src="/storage/images/{{ $checkout->booking->room->photo }}" alt="">
                            </div>
                            <div class="col-md-7 my-3">
                                <h3 class="fw-bold text-teal">
                                    {{ $checkout->booking->room->accomodation->name }}
                                </h3>
                                <p class="text-dark">
                                    {{ $checkout->booking->room->accomodation->address }},
                                    {{ $checkout->booking->room->accomodation->city->name }},
                                    {{ $checkout->booking->room->accomodation->city->country }}</p>
                                <small class="text-muted">{{ $checkout->booking->room->description }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 my-3">
                <div class="card border-0 rounded-30 shadow" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-easing="ease-in-out">
                    <div class="card-body my-3">
                        <form action="{{ route('storeRating') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="wraper">
                                <h3 class="text-center fw-bold text-teal">How's your experience for this place?</h3>
                                <hr>
                                <div class="rating">
                                    <select class="form-select" name="star" id="star">
                                        <option value="">Choose Rating...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group comment">
                                    <textarea type="comment" class="form-control" id="comment" name="comment"
                                        aria-describedby="emailHelp" placeholder="Add Comment..."></textarea>
                                    <small id="emailHelp" class="form-text text-muted comdetail">We'll never share your
                                        Comment
                                        with
                                        anyone else.</small>
                                </div>

                                <input type="hidden" name="accomodation_id"
                                    value="{{ $checkout->booking->room->accomodation_id }}">
                                <input type="hidden" name="checkout_id" value="{{ $checkout->id }}">

                                <div class="d-flex justify-content-center line3 submit">
                                    <div class="submit-search-city justify-content-center">
                                        <input type="Submit" value="Submit" class="btn btn-submit" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
