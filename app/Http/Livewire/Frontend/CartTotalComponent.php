<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class CartTotalComponent extends Component
{
    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;

    protected $listeners = [
        'updateCart'=>'mount',
    ];

    public function mount(){
        $this->cart_subtotal = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->subtotal();
        $this->cart_tax = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->tax();
        $this->cart_total = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->total();
    }
    public function render()
    {
        return view('livewire.frontend.cart-total-component');
    }
}
