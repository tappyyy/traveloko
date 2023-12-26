@extends('layouts.app') @section('content')
<form action="{{ route('storeAccomodation') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">name</label>
    <input type="text" name="name" id="name">
    <label for="category">category</label>
    <input type="text" name="category" id="category">
    <label for="photo">photo</label>
    <input type="file" name="photo" id="photo">
    <label for="city">city</label>
    <input type="text" name="city" id="city">
    <label for="address">address</label>
    <input type="text" name="address" id="address">
    <button type="submit">Submit</button>
</form>

@endsection
