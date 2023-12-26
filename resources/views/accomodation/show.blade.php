@extends('layouts.app')
@section('title', "Result")
@section('content')
    <div class="container py-5">
        <div class="header-accomodation">
            <h1>Accomodation List</h1>

        </div>
        @foreach ($accomodations as $accomodation)
            <div class="card my-3 mb-4 ">
                <div class="card-body px-5">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="rounded" src="/storage/images/{{ $accomodation->photo }}" width="100%" alt="">
                        </div>
                        <div class="col-md-7">
                            <h3>{{ $accomodation->name }}</h3>
                            <p>{{ $accomodation->category->category_name }}</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <h4>Rp {{ number_format($accomodation->cheaperRoom->price) }}</h4>
                            @if (Auth::user()->role == 'ADMIN')
                            <a class="btn btn-warning "
                                href="">EDIT</a>
                                <a class="btn btn-danger "
                                href="/accomodations/delete{{$accomodation->id}}">DELETE</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
