@extends('layouts.app')

@section('title', 'Classifieds Board')

@section('content')

    <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item  {{ Route::currentRouteName() == 'advertisement.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('advertisement.index') }}">All</a>
            </li>
            @php
                $category_id = $category->id ?? '';
            @endphp
            @foreach ($categories as $cat)
                <li class="nav-item {{ $category_id === $cat->id ? 'active' : '' }}">
                    <a class="nav-link"
                        href="{{ route('advertisement.adsByCategory', $cat->id) }}">{{ $cat->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="row mx-3">
        @foreach ($ads as $ad)
            <div class="col-3 p-0">
                <div class="card m-2 p-0">
                    <a href="{{ route('advertisement.show', $ad->id) }}">
                        <img src="{{ $ad->image_url }}" class="card-img-top"></a>
                    <p class="text-right text-muted p-2 m-0">{{ $ad->price }} &euro;</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $ads->links() }}
    </div>

@endsection
