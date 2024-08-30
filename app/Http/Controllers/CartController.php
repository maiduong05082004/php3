<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function getCategories()
    {
        return Category::where('parent_id', null)
            ->where('id', '<>', 0)
            ->with('children.children')
            ->where('status', '<>', 3)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function cart()
    {
        $categories = $this->getCategories();
        $cart = Session::get('cart', []);
        return view('client.cart', compact('categories', 'cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min=1',
        ]);

        $variant = ProductVariant::findOrFail($request->variant_id);

        $cart = Session::get('cart', []);

        $cartItem = [
            'product_id' => $request->product_id,
            'variant_id' => $variant->id,
            'name' => $variant->product->name,
            'color' => $variant->color->name,
            'size' => $variant->size->name,
            'price' => $variant->priceSale ?? $variant->price,
            'quantity' => $request->quantity,
            'image' => $variant->images->first()->url ?? null,
        ];

        $cart[] = $cartItem;

        Session::put('cart', $cart);

        return response()->json(['success' => 'Product added to cart successfully!']);
    }
}