<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
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

    public function checkout()
    {
        $categories = $this->getCategories();
        $cart = Cart::where('user_id', Auth::id())->get();
        // Tổng số tiền và các thông tin khác có thể được tính toán và truyền vào view
        $totalAmount = $cart->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('client.checkout', compact('cart', 'totalAmount', 'categories'));
    }

    public function submit(Request $request)
    {
        // Kiểm tra các trường form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('checkout')
                ->withErrors($validator)
                ->withInput();
        }
        $totalAmount = 0;
        $shippingFee = 12;
        $cityName = $request->city;
        // Tính tổng số tiền
        foreach (Cart::where('user_id', Auth::id())->get() as $item) {
            $totalAmount += $item->price * $item->quantity;
        }
        if ($cityName == 1 || $cityName == 79) {
            $shippingFee = 6; // Giảm phí cho các thành phố lớn
        }
        if ($totalAmount > 1000) {
            $shippingFee = 0; // Miễn phí nếu tổng số tiền lớn hơn $1000
        }
        // Tính tổng tiền bao gồm phí vận chuyển
        $grandTotal = $totalAmount + $shippingFee;
        // Tạo mã đơn hàng
        $orderCode = 'MD' . rand(0000, 9999) . 'H' . time();
        // Lưu thông tin đơn hàng vào database
        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->district = $request->district;
        $order->ward = $request->ward;
        $order->payment_method = $request->payment_method;
        $order->total_amount = $grandTotal;
        $order->order_code = $orderCode; // Lưu mã đơn hàng
        $order->save();

        // Lưu thông tin sản phẩm vào bảng order_items
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->variant_id = $item->variant_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->save();
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        Cart::where('user_id', Auth::id())->delete();

        // Chuyển hướng đến trang thành công
        return redirect()->route('order.success', ['id' => $order->id]);
    }
}
