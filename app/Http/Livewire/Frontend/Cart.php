<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Cart extends Component
{
    use LivewireAlert;
    public $cartCount;
    public $wishlistCount;

    protected $listeners=[
        'updateCart'=>'update_cart',
        'removeFromCart'=>'remove_from_cart',
        'removeFromWishList'=>'remove_from_wish_list',
        'moveToCart'=>'move_to_cart'
    ];

    public function remove_from_cart($rowId)
    {

        \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->remove($rowId);
        $this->emit('updateCart');
        $this->alert('success','Item removed from your Cart!');

        if (\Gloudemans\Shoppingcart\Facades\Cart::instance('default')->count()==0){

            return redirect()->route('frontend.cart');
        }
    }

    public function move_to_cart($rowId)
    {

       $item =  \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->get($rowId);
       $duplicate = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->search(function ($cartItem,$rId) use($rowId){

           return $rId === $rowId;
       });

       if ($duplicate->isNotEmpty()){

           \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->remove($rowId);
           $this->alert('error','Product already exist!');

       }else{
           \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->add($item->id,$item->name,1,$item->price)->associate(Product::class);
           \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->remove($rowId);
           $this->alert('success','Product added in your Cart successfully!');

       }

        $this->emit('updateCart');
        if (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count()==0){

            return redirect()->route('frontend.wishlist');
        }
    }

 public function remove_from_wish_list($rowId)
    {

        \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->remove($rowId);
        $this->emit('updateCart');
        $this->alert('success','Item removed from your wish list!');
        if (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count()==0){

            return redirect()->route('frontend.wishlist');
        }
    }

    public function mount(){

        $this->cartCount = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->count();
        $this->wishlistCount = \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count();
    }

    public function update_cart(){

        $this->cartCount = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->count();
        $this->wishlistCount = \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count();


    }


    public function render()
    {
        return view('livewire.frontend.cart');
    }
}
