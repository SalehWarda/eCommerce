<?php

namespace App\Helper;

use Gloudemans\Shoppingcart\Facades\Cart;

trait getNumbers
{
    function getNumbers()
    {

        $subtotal = Cart::instance('default')->subtotal();
        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;

        $subtotal_after_discount = $subtotal - $discount;

        $tax = config('cart.tax') / 100;
        $taxText = config('cart.tax') . '%';


        $productTaxes = round($subtotal_after_discount * $tax, 2);
        $newSubTotal = $subtotal_after_discount + $productTaxes;

        $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;

        $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping,2):0.00;
        return collect([
            'subtotal' => $subtotal,
            'tax'      => $tax,
            'taxText'  => $taxText,
            'productTaxes' => (float)$productTaxes,
            'newSubTotal' => (float)$newSubTotal,
            'discount'   => (float)$discount,
            'shipping'   => (float)$shipping,
            'total'    => (float)$total,

        ]);
    }

}
