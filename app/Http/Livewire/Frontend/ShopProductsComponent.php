<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Gloudemans\Shoppingcart\Facades\Cart;
use http\Client\Curl\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProductsComponent extends Component
{
    use WithPagination,LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';


    public function addToCart($id){

        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use($product){

            return $cartItem->id === $product->id;
        });
        if ($duplicates->isNotEmpty()){
            $this->alert('error', 'Product already exist!');

        }else{


            Cart::instance('default')->add($product->id,
                $product->name,
                1,
                $product->price,

            )->associate(Product::class);

            $this->emit('updateCart');
            $this->alert('success', 'Product added in your cart successfully!');
        }



    }


    public function addToWishList($id){

        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use($product){

            return $cartItem->id === $product->id;
        });
        if ($duplicates->isNotEmpty()){
            $this->alert('error', 'Product already exist!');

        }else{


            Cart::instance('wishlist')->add($product->id,
                $product->name,
                1,
                $product->price,

            )->associate(Product::class);
            $this->emit('updateCart');

            $this->alert('success', 'Product added in your wishlist cart successfully!');
        }


    }

    public function render()
    {


        switch ($this->sortingBy){

            case 'popularity':

                $sort_field = 'id';
                $sort_type  = 'asc';

                break;

                case 'low-high':

                    $sort_field = 'price';
                    $sort_type  = 'asc';

                break;

                case 'high-low':

                    $sort_field = 'price';
                    $sort_type  = 'desc';

                break;

                default;

                    $sort_field = 'id';
                    $sort_type  = 'asc';
        }





        $products = Product::with('firstMedia');
        if ($this->slug == ''){

            $products = $products->ActiveCategory();

        }else{

            $productCategor = ProductCategory::whereSlug($this->slug)->whereStatus(true)->first();
            if (is_null($productCategor->parent_id)){
                $categoriesIds = ProductCategory::whereParnetId($productCategor->id)
                    ->whereStatus(true)->pluck('id')->toArray();
                $products = $products->whereHas('category',function ($query) use($categoriesIds){

                    $query->whereIn('id',$categoriesIds);
                });
            }else{
                $products = $products->with('category')->whereHas('category',function ($query){

                    $query->where([
                        'slug' => $this->slug,
                        'status' => true,
                    ]);
                });
      }

        }

        $products = $products->Active()->HasQuantity()->orderBy($sort_field,$sort_type)->paginate($this->paginationLimit);

        $productCategories = ProductCategory::with('parent','appearedChildren')->whereStatus(true)->whereNull('parent_id')->get();

        $productTags = Tag::with('products')->whereStatus(true)->get();

        return view('livewire.frontend.shop-products-component',[

                 'products' => $products,
                 'productCategories' => $productCategories,
                 'productTags' => $productTags
        ]);
    }
}