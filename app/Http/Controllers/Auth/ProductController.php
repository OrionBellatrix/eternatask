<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ImageService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryRepository $categoryRepository,
        protected LogService $logService,
        protected ImageService $imageService
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getByAuthenticatedUser()->paginate(relations: ['categories']);

        return view('auth.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();

        return view('auth.products.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $result = DB::transaction(function () use ($data, $request) {
            try {
                list($width, $height) = config('eterna.category_image_size');

                $image = $request->file('image');
                $imageName = $this->imageService->uploadAndCrop($image, $width, $height);

                $data['image'] = $imageName;
                $data['user_id'] = Auth::id();

                $product = $this->productRepository->create($data);
                $product->categories()->attach($data['categories']);
                return $product;
            } catch (\Exception $e) {
                $this->logService->logError(__('Ürün oluşturma sırasında hata oluştu.'), ['error' => $e->getMessage()]);
                $this->imageService->deleteImage($data['image']);
                return false;
            }
        });

        return $result
            ? redirect()->route('products.edit', $result->id)->with('success', __('Ürün başarılı bir şekilde oluşmuştur.'))
            : redirect()->back()->withInput()->withErrors(__('Ürün oluşturma sırasında hata oluştu.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryRepository->all();
        $product = $this->productRepository->getByAuthenticatedUser()->find($id);
        return view('auth.products.edit', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();

        $result = DB::transaction(function () use ($data, $request, $id) {
            try {
                list($width, $height) = config('eterna.product_image_size');
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = $this->imageService->uploadAndCrop($image, $width, $height);
                    $data['image'] = $imageName;
                }
                $data['user_id'] = Auth::id();

                $product = $this->productRepository->update($id, $data);
                $product->categories()->sync($data['categories']);
                return $product;
            } catch (\Exception $e) {
                $this->logService->logError(__('Ürün güncelleme sırasında hata oluştu.'), ['error' => $e->getMessage()]);
                if (isset($data['image'])) {
                    $this->imageService->deleteImage($data['image']);
                }
                return false;
            }
        });

        return $result
            ? redirect()->route('products.edit', $result->id)->with('success', __('Ürün başarılı bir şekilde oluşmuştur.'))
            : redirect()->back()->withInput()->withErrors(__('Ürün güncelleme sırasında hata oluştu.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productRepository->getByAuthenticatedUser()->find($id);
        $this->imageService->deleteImage($product->image);
        $this->productRepository->getByAuthenticatedUser()->delete($id);

        return redirect()->back()->with('success', __('Ürün başarılı bir şekilde silinmiştir.'));
    }
}
