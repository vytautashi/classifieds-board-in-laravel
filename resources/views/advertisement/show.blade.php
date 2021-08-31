@extends('layouts.app')

@section('title', 'Advertisement: ' . $ad->id)

@section('content')

    <div class="container bg-white p-3">
        <form class="text-right" method="post" action="{{ route('advertisement.destroy', $ad->id) }}">
            @csrf
            @method('DELETE')
            <a class="btn btn-primary mr-2" href="{{ route('advertisement.edit', $ad->id) }}">Edit</a>
            <button type="submit" class="btn btn-secondary">Delete</button>
        </form>


        <div class="row">
            <img class="col-6" src="{{ $ad->image_url }}">

            <div class="col">
                <h5><b>id: </b>{{ $ad->id }}</h5>
                <h5><b>price: </b>{{ $ad->price }} &euro;</h5>
                <h5><b>description:</b></h5>
                <p>{{ $ad->description }}</p>
            </div>
        </div>



    </div>
@endsection
