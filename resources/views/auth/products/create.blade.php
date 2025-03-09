@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="h5 mb-0">{{ __('Yeni Ürün') }}</h5>
    </div>

    <div class="mt-4">
        @include('layouts.alert')
        <form action="{{ route('products.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">{{ __('Ürün Adı') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="required" placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="price">{{ __('Ürün Fiyatı') }}</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required="required" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="form-group mb-3">
                            <label for="categories">{{ __('Kategoriler') }}</label>
                            <select name="categories[]" id="categories" class="form-control select2" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="form-group mb-3">
                            <label for="description">{{ __('Ürün Açıklaması') }}</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! old('description') !!}</textarea>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="image">{{ __('Ürün Resmi') }}</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>
            </div>

            <button class="btn btn-success mt-2 float-end"><i class="fa-solid fa-save"></i> {{ __('Kaydet') }}</button>
        </form>
    </div>
@endsection

@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>
    <script type="module">
        $(document).ready(function () {
            $(".select2").select2();
        })
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
