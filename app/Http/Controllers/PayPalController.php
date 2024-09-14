<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function payment(Request $request){
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

        if(isset($response['id']) && $response['id'] != null){
            foreach($response['links'] as $link){
                if($link['rel'] === 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        } else{
            return redirect()->route('paypal_cancel');
        }
    }

    public function success(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        // Capture the payment
        $response = $provider->capturePaymentOrder($request->token);
        
        // Kiểm tra phản hồi và lưu thông tin đơn hàng
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Lưu thông tin đơn hàng vào database
            $order = new Order();
            $order->user_id = Auth::id();
            $order->order_code = 'MD' . rand(0000, 9999) . 'H' . time(); // Tạo mã đơn hàng
            $order->total_amount = $request->grand_total;
            $order->payment_method = 'PayPal'; // Phương thức thanh toán
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

    public function cancel() {
        return redirect()->route('checkout')->with('error', 'Payment was canceled.');
    }
}