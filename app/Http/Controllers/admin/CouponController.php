<?php

namespace App\Http\Controllers\admin;

use App\Models\Coupon;
use App\Models\User; // Model User
use App\Models\Product; // Model Product
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        // Lấy danh sách người dùng và sản phẩm
        $users = User::all();
        $products = Product::all();
        return view('admin.coupons.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons',
            'discount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percent',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'min_order_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,used',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $users = User::all(); // Lấy danh sách người dùng
        $products = Product::all(); // Lấy danh sách sản phẩm
        return view('admin.coupons.edit', compact('coupon', 'users', 'products'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $id,
            'discount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percent',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'min_order_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,used',
        ]);

        $coupon->update($request->all());

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
