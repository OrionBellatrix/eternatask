@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="h5 mb-0">{{ __('Ürünler') }}</h5>
        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm"><i class="fa-solid fa-plus-circle"></i> {{ __('Yeni Ürün') }}</a>
    </div>

    @include('layouts.alert')
    <div class="mt-4">
        <table class="table table-bordered">
            <thead class="table-primary">
            <tr>
                <td width="100">{{ __('Resim') }}</td>
                <td>{{ __('Adı') }}</td>
                <td>{{ __('Kategoriler') }}</td>
                <td width="150">{{ __('İşlemler') }}</td>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td><img style="width: 40px" src="{{ asset('storage/'.$product->image) }}" alt=""></td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach($product->categories as $category)
                            <span class="badge text-bg-secondary">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bars"></i> {{ __('İşlemler') }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products.edit', $product) }}"><i class="fa-solid fa-edit"></i> {{ __('Düzenle') }}</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="removeItem('{{ $product->id }}')"><i class="fa-solid fa-trash"></i> {{ __('Sil') }}</a></li>
                                <form action="{{ route('products.destroy', $product) }}" id="remove-item-{{$product->id}}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="alert alert-warning">
                            <i class="fa-solid fa-info-circle"></i> {{ __('Kayıtlı bir ürün bulunamadı.') }}
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script>
        function removeItem(id) {
            Swal.fire({
                icon: "info",
                title: "Silmek istediğinize emin misiniz?",
                showCancelButton: true,
                confirmButtonText: "Evet, Sil!",
                cancelButtonText: "Vazgeç"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`remove-item-${id}`).submit();
                } else if (result.isDenied) {
                    Swal.fire("Silme işlemi iptal edildi", "", "info");
                }
            });

        }
    </script>
@endpush
