<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $cart = Cart::where('user_id', Auth::id())->get();

        // Tính tổng tiền và phí giao dịch
        $totalAmount = $cart->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $fee = $totalAmount > 1000 ? 0 : 12;
        $grandTotal = $totalAmount + $fee;

        return view('client.cart', compact('categories', 'cart', 'totalAmount', 'fee', 'grandTotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $variant = ProductVariant::findOrFail($request->variant_id);
        // Tạo hoặc cập nhật giỏ hàng trong cơ sở dữ liệu
        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'variant_id' => $variant->id,
            ],
            [
                'quantity' => $request->quantity,
                'price' => $variant->priceSale ?? $variant->price,
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);
    
        foreach ($request->quantities as $cartId => $quantity) {
            $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
            if ($cartItem) {
                $cartItem->update(['quantity' => $quantity]);
            }
        }
    
        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
    }

    public function remove(string $id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
}
