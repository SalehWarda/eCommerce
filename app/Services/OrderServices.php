<?php

namespace App\Services;

use App\Helper\getNumbers;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\ProductCoupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderServices
{
  use getNumbers;
    public function createOrder($request)
    {

        $order = Order::create([

            'ref_id' => 'ORD-' .Str::random(15),
            'user_id' => auth()->id(),
            'customer_address_id' => $request['customer_address_id'],
            'shipping_company_id' => $request['shipping_company_id'],
            'payment_method_id' => $request['payment_method_id'],
            'subtotal' => $this->getNumbers()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code']:null,
            'discount' => $this->getNumbers()->get('discount'),
            'shipping' => $this->getNumbers()->get('shipping'),
            'tax' => $this->getNumbers()->get('productTaxes'),
            'total' => $this->getNumbers()->get('total'),
            'currency' => 'USD',
            'order_status' => 0,
        ]);

        foreach (Cart::content() as $item) {

//            $order->product()->create([
//                'product_id' => $item->model->id,
//                'quantity' => $item->qty,
//            ]);

          OrderProduct::create([

              'order_id' => $order->id,
              'product_id' => $item->model->id,
              'quantity' => $item->qty,
          ]);


          $product = Product::find($item->model->id);
          $product->update([

              'quantity' => $product->quantity - $item->qty,
          ]);

        }

        if (session()->has('coupon')){

            $coupon = ProductCoupon::whereCode(session()->get('coupon')['code'])->first();
            $coupon->increment('used_times');
        }

        $order->transactions()->create([

            'transaction' => OrderTransaction::NEW_ORDER
        ]);
        return $order;
    }


}
