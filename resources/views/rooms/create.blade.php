@extends('layouts.app')
@section('title', "Create Accomodation")
@section('content')
<form action="{{ route('createRoom') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="accomodation_id">Accomodation ID</label>
    <input type="text" name="accomodation_id" id="accomodation_id" value="1">

    <label for="type">Type</label>
    <input type="text" name="type" id="type">

    <label for="room_photo">photo</label>
    <input type="file" name="room_photo" id="room_photo">

    <label for="desciption">Description</label>
    <input type="text" name="description" id="description">

    <label for="slot">Slot</label>
    <input type="text" name="slot" id="slot">

    <label for="price">Price</label>
    <input type="text" name="price" id="price">
    <button type="submit">Submit</button>
</form>


@endsection
