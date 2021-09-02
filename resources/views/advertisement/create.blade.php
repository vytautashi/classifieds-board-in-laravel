@extends('layouts.app')

@section('title', 'Post new advertisement')

@section('content')
    <div class="container bg-white p-4">

        <h1>Post advertisement</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="pl-4 m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data" action="{{ route('advertisement.index') }}">
            @csrf
            <label for="category_id" class="mt-2 mb-1">Category:</label>
            <select class="form-control col-sm-8" id="category_id" name="category_id">
                <option>Select category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? ' selected' : '' }}>
                        {{ $cat->title }}</option>
                @endforeach
            </select>

            <label for="description" class="mt-2 mb-1">Description:</label>
            <textarea class="form-control col-sm-8" id="description" name="description" rows="4"
                cols="50">{{ old('description') }}</textarea>

            <label for="image" class="mt-2 mb-1">Image:</label>
            <input type="file" class="form-control col-sm-8" id="image" name="image">

            <label for="price" class="mt-2 mb-1">Price:</label>
            <input type="number" class="form-control col-sm-2" id="price" name="price" min="0.00" step="0.01"
                value="{{ old('price') ?? 0 }}" /><br>

            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
@endsection
