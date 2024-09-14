<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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
        session([
            'checkout_data' => $request->only(['name', 'phone', 'email', 'address', 'city', 'district', 'ward', 'payment_method']),
            'grand_total' => $request->grand_total
        ]);
        // Xử lý thanh toán bằng PayPal
        if ($request->payment_method == 'Paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('paypal_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $request->grand_total
                        ]
                    ]
                ]
            ]);

            // Kiểm tra phản hồi từ PayPal
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal_cancel');
            }
        }
    }
    public function cancel()
    {
        return redirect()->route('checkout')->with('error', 'Payment was canceled.');
    }
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        // Capture the payment
        $response = $provider->capturePaymentOrder($request->token);
        
        // Kiểm tra phản hồi và lưu thông tin đơn hàng
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Lấy thông tin từ session
            $checkoutData = session('checkout_data');
            $orderCode = 'MD' . rand(0000, 9999) . 'H' . time();
    
            // Lưu thông tin đơn hàng vào database
            $order = new Order();
            $order->user_id = Auth::id();
            $order->name = $checkoutData['name'];
            $order->phone = $checkoutData['phone'];
            $order->email = $checkoutData['email'];
            $order->address = $checkoutData['address'];
            $order->city = $checkoutData['city'];
            $order->district = $checkoutData['district'];
            $order->ward = $checkoutData['ward'];
            $order->payment_method = $checkoutData['payment_method'];
            $order->total_amount = session('grand_total');
            $order->order_code = $orderCode;
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
    
            return redirect()->route('order.success', ['id' => $order->id]);
        } else {
            return redirect()->route('paypal.cancel')->with('error', 'Payment failed.');
        }
    }
}
