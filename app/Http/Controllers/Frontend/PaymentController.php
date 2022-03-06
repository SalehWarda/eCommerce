<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\OmniPayService;
use App\Services\OrderServices;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use function Clue\StreamFilter\fun;

class PaymentController extends Controller
{

    public function checkout_now(Request $request)
    {
        //
        $order =( new OrderServices)->createOrder($request->except(['_token','submit']));
        $omniPay = new OmniPayService('PayPal_Express');
        $response = $omniPay->purchase([
            'amount' => $order->total,
            'transactionId' => $order->id,
            'currency' => 'USD',
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl'  => $omniPay->getReturnUrl($order->id)
        ]);

        if ($response->isRedirect()){

            $response->redirect();

        }

        toast($response->getMessage(),'error');
        return redirect()->route('frontend.index');
    }


    public function cancelled($order_id)
    {
        //
        $order = Order::find($order_id);
        $order->update([

            'order_status'  => Order::CANCELED
        ]);
        $order->products()->each(function ($order_product){

            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([

                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);

        });
        toast('You have cancelled your Order payment!','error');
        return redirect()->route('frontend.index');
    }

    public function completed($order_id)
    {
        //
        $order = Order::find($order_id);
        $order->update([

            'order_status'  => Order::CANCELED
        ]);
        $order->products()->each(function ($order_product){

            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([

                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);

        });
        toast('You have cancelled your Order payment!','error');
        return redirect()->route('frontend.index');


    }

    public function webhook($order,$env)
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
