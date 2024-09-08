<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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
    public function show($id)
    {
        $categories = $this->getCategories();
        // Lấy thông tin đơn hàng theo ID
        $order = Order::with('items.product', 'items.variant')->findOrFail($id);

        // Kiểm tra xem người dùng có quyền xem đơn hàng này không
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền xem đơn hàng này.');
        }
        $feeShip = 12;
        if($order->city == 1 || $order->city == 79){
            $feeShip = 6;
        }
        // Trả về view với thông tin đơn hàng
        return view('client.orderSuccess', compact('order','categories','feeShip'));
    }



}