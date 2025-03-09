@extends('menu.layouts')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h5>{{ $category->name }}</h5>
            <a class="text-decoration-none text-black" href="{{ route('menu.show', ['username' => $user->username]) }}"><i class="fa-solid fa-arrow-left"></i> Geri</a>
        </div>
        <div class="row">
            @forelse($products as $product)
                <div class="col-xl-3 col-md-4 col-sm-6 col-6 mb-3" onclick="productDetail('{{ route('product.show', ['username' => $user->username, 'category_slug' => $category->slug, 'product_slug' => $product->slug]) }}')">
                    <div>
                        <div class="image-container">
                            <img class="w-100" src="{{ asset('storage/'. $product->image) }}" alt="">
                        </div>
                        <p class="text-center mb-0">{{ $product->name }}</p>
                        <div class="price-btn w-100">{{ number_format($product->price, 2, ',', '.') }} ₺</div>
                    </div>
                </div>
            @empty
            <div class="alert alert-warning">
                {{ __('Bu kategoride bir ürün bulunamadı!') }}
            </div>
            @endforelse
        </div>
    </div>


    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="" alt="" id="product-image" class="w-100">
                        </div>
                        <div class="col-6">
                            <h5 id="product-name"></h5>
                            <p id="product-price"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col" id="description"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Kapat') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function productDetail(url) {
            axios.get(url).then(function (response) {
                const product = response.data.product;
                const productModal = new bootstrap.Modal('#productModal');
                document.getElementById('productModalLabel').innerHTML = product.name
                document.getElementById('product-image').src = product.image
                document.getElementById('product-name').innerHTML = product.name
                document.getElementById('product-price').innerHTML = `Fiyat: ${product.price} ₺`
                document.getElementById('description').innerHTML = product.description
                productModal.show();
            });
        }
    </script>

@endpush
