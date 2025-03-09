<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Repositories\{CategoryRepository, ProductRepository, UserRepository};

class MenuController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository,
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository,
    ){}

    /**
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function showMenu($username)
    {
        $user = $this->userRepository->findEmailOrUsername($username);
        $categories = $this->categoryRepository->getByAuthenticatedUser($user->id)->all();

        return view('menu.index', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    /**
     * @param $username
     * @param $category_slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function showCategory($username, $category_slug)
    {
        $user = $this->userRepository->findEmailOrUsername($username);
        $category = $this->categoryRepository->findBySlug($category_slug);
        $products = $category->products;

        return view('menu.category', [
            'user' => $user,
            'category' => $category,
            'products' => $products,
        ]);
    }

    /**
     * @param $username
     * @param $category_slug
     * @param $product_slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function showProduct($username, $category_slug, $product_slug)
    {
        $product = $this->productRepository->findBySlug($product_slug);
        $product->image = asset('storage/'. $product->image);

        return response()->json([
            'product' => $product
        ]);
    }
}
