@extends('layouts.app')

@section('title', 'My advertisements')

@section('content')

    <div class="row mx-3">
        @forelse ($ads as $ad)
            <div class="col-2 p-0">
                <div class="card m-2 p-0">
                    <a href="{{ route('advertisement.show', $ad->id) }}">
                        <img src="{{ $ad->image_url }}" class="card-img-top"></a>
                    <p class="text-right text-muted p-2 m-0">{{ $ad->price }} &euro;</p>


                    <form class="text-center pb-2" method="post" action="{{ route('advertisement.destroy', $ad->id) }}">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-primary mr-2 py-0" href="{{ route('advertisement.edit', $ad->id) }}">Edit</a>
                        <button type="submit" class="btn btn-secondary py-0">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            You have no advertisements.
        @endforelse
    </div>

@endsection
