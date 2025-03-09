<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\ImageService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ImageService $imageService,
        protected LogService $logService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getByAuthenticatedUser()->paginate();

        return view('auth.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $result = DB::transaction(function () use ($data, $request) {
            try {
                list($width, $height) = config('eterna.category_image_size');

                $image = $request->file('image');
                $imageName = $this->imageService->uploadAndCrop($image, $width, $height);

                $data['image'] = $imageName;
                $data['user_id'] = Auth::id();

                return $this->categoryRepository->create($data);
            } catch (\Exception $e) {
                $this->logService->logError(__('Kategori oluşturma sırasında hata oluştu.'), ['error' => $e->getMessage()]);
                $this->imageService->deleteImage($data['image']);
                return false;
            }
        });

        return $result
            ? redirect()->route('categories.edit', $result->id)->with('success', __('Kategori başarılı bir şekilde oluşmuştur.'))
            : redirect()->back()->withInput()->withErrors(__('Kategori oluşturma sırasında hata oluştu.'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryRepository->getByAuthenticatedUser()->find($id);

        return view('auth.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->validated();

        $result = DB::transaction(function () use ($data, $request, $id) {
            try {
                list($width, $height) = config('eterna.category_image_size');
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = $this->imageService->uploadAndCrop($image, $width, $height);
                    $data['image'] = $imageName;
                }
                return $this->categoryRepository->getByAuthenticatedUser()->update($id, $data);
            } catch (\Exception $e) {
                $this->logService->logError(__('Kategori güncelleme sırasında hata oluştu.'), ['error' => $e->getMessage()]);
                if (isset($data['image'])) {
                    $this->imageService->deleteImage($data['image']);
                }
                return false;
            }
        });

        return $result
            ? redirect()->route('categories.edit', $result->id)->with('success', __('Kategori başarılı bir şekilde güncellenmiştir.'))
            : redirect()->back()->withInput()->withErrors(__('Kategori güncelleme sırasında hata oluştu.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryRepository->getByAuthenticatedUser()->find($id);
        $this->imageService->deleteImage($category->image);
        $this->categoryRepository->getByAuthenticatedUser()->delete($id);

        return redirect()->back()->with('success', __('Kategori başarılı bir şekilde silinmiştir.'));
    }
}
