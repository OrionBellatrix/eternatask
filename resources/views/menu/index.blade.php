@extends('menu.layouts')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-xl-3 col-md-4 col-sm-6 col-6 mb-4">
                    <a href="{{ route('category.show', ['username' => $user->username, 'category_slug' => $category->slug]) }}">
                        <div class="image-container">
                            <img class="w-100" src="{{ asset('storage/'. $category->image) }}" alt="">
                            <div class="overlay">{{ $category->name }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
