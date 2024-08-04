<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.home');
    }
    public function productDetail()
    {
        return view('client.productDetail');
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
