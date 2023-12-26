@extends('layouts.app')
@section('title', 'Covid-19 Info')
@section('content')
    <div class="covid-content text-center mt-5 mb-5">
       <h1 class="mb-5">COVID-19 Updates</h1>
       <iframe class="shadow" src="{{ route("covidnews") }}" frameborder="0" width="1000px" height="800px"></iframe>
    </div>
@endsection
