<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $images[] =['file_name'=>'product-1.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-2.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-3.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-4.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-5.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-6.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-7.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];
        $images[] =['file_name'=>'product-8.jpg','file_type'=>'image/jpg','file_size'=>rand(100,900),'file_status'=>true,'file_sort'=>0];

        Product::all()->each(function ($product) use ($images){

            $product->media()->createMany(Arr::random($images,rand(2,3)));
        });
    }
}
