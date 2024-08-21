<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $categories = Category::where('parent_id', null)
        ->where('id', '<>', 0)
        ->with('children.children')
        ->where('status', '<>', 3)
        ->orderBy('id', 'asc')
        ->get();
        $banners = Banner::all();
        $products = Product::where('status', '<>', 3)->with('category')->orderBy('id', 'desc')->get();

        return view('client.home', compact('categories', 'banners', 'products'));
    }

    public function productDetail($id)
    {
        $categories = Category::where('parent_id', null)
            ->where('id', '<>', 0)
            ->with('children')
            ->where('status', '<>', 3)
            ->orderBy('id', 'asc')
            ->get();

        $product = Product::with(['variants.color', 'variants.size', 'variants.images'])
            ->findOrFail($id);
            $prices = $product->variants->pluck('price')->all();
            $minPrice = min($prices);
            $maxPrice = max($prices);
        return view('client.productDetail', compact('categories', 'product', 'minPrice', 'maxPrice'));
    }

    public function category()
    {
        return view('client.category');
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
