<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {}
    
    private function getCategories()
    {
        return Category::where('parent_id', null)
            ->where('id', '<>', 0)
            ->with('children.children')
            ->where('status', '<>', 3)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function index()
    {
        $categories = $this->getCategories();
        $banners = Banner::all();
        $products = Product::where('status', '<>', 3)->with('category')->orderBy('id', 'desc')->get();

        return view('client.home', compact('categories', 'banners', 'products'));
    }

    public function showCategoryProducts($id)
    {
        if (empty($id) || !is_numeric($id)) {
            return redirect()->back()->withErrors(['error' => 'Invalid category ID']);
        }

        $categories = $this->getCategories();
        $category = Category::findOrFail($id);
        $categoryIds = $this->getAllChildrenIds($category);

        if (!empty($id) && is_numeric($id)) {
            $categoryIds[] = $id;
        }

        $products = Product::whereIn('category_id', $categoryIds)
            ->where('status', '<>', 3)
            ->paginate(6);

        return view('client.category', compact('categories', 'products', 'category'));
    }

    private function getAllChildrenIds($category)
    {
        $ids = [];

        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllChildrenIds($child));
        }

        return $ids;
    }

    public function productDetail($id)
    {
        $categories = $this->getCategories();

        $product = Product::with(['variants.color', 'variants.size', 'variants.images'])
            ->findOrFail($id);
        $prices = $product->variants->pluck('price')->all();
        $minPrice = min($prices);
        $maxPrice = max($prices);
        return view('client.productDetail', compact('categories', 'product', 'minPrice', 'maxPrice'));
    }

    public function category()
    {
        $categories = $this->getCategories();
        $products = Product::whereHas('category')->get();
        return view('client.category', compact('categories', 'products'));
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function blogDetail()
    {
        return view('client.blogDetail');
    }

    public function contract()
    {
        return view('client.contract');
    }

    public function faq()
    {
        return view('client.faq');
    }

    public function termsConditions()
    {
        return view('client.termsConditions');
    }

    public function myWishlist()
    {
        return view('client.myWishlist');
    }

    public function cart()
    {
        return view('client.cart');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function NotFound()
    {
        return view('404');
    }
}
