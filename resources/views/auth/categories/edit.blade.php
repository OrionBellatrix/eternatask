@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="h5 mb-0">{{ __('Kategoriyi Düzenle') }}</h5>
{{--        <a href="{{ route('categories.index') }}" class="btn btn-dark btn-sm"><i class="fa-solid fa-chevron-left"></i> {{ __('Geri Dön') }}</a>--}}
    </div>

    <div class="mt-4">
        @include('layouts.alert')
        <form action="{{ route('categories.update', $category) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="name">{{ __('Kategori Adı') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category) }}" required="required" placeholder="">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="image">{{ __('Kategori Resmi') }}</label>
                        <img class="d-block mb-3" src="{{ asset('storage/'. $category->image) }}" alt="{{ $category->name }}" style="border: 1px solid #ebebeb; padding: 5px; width: 200px">
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>
            </div>

            <button class="btn btn-success mt-2 float-end"><i class="fa-solid fa-save"></i> {{ __('Güncelle') }}</button>
        </form>
    </div>
@endsection
