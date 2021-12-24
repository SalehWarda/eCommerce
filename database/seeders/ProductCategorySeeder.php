<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $clothes = ProductCategory::create(['name' => 'Clothes','cover'=>'clothes.jpg','status'=>true,'parent_id'=>null]);
        ProductCategory::create(['name' => 'Men\'s','cover'=>'clothes.jpg','status'=>true,'parent_id'=>$clothes->id]);
        ProductCategory::create(['name' => 'Women\'s','cover'=>'clothes.jpg','status'=>true,'parent_id'=>$clothes->id]);
        ProductCategory::create(['name' => 'Dresses','cover'=>'clothes.jpg','status'=>true,'parent_id'=>$clothes->id]);
        ProductCategory::create(['name' => 'Novelty Sock','cover'=>'clothes.jpg','status'=>true,'parent_id'=>$clothes->id]);


        $shoes = ProductCategory::create(['name' => 'Shoes','cover'=>'shoes.jpg','status'=>true,'parent_id'=>null]);
        ProductCategory::create(['name' => 'Men\'s Shoes','cover'=>'shoes.jpg','status'=>true,'parent_id'=>$shoes->id]);
        ProductCategory::create(['name' => 'Women\'s Shoes','cover'=>'shoes.jpg','status'=>true,'parent_id'=>$shoes->id]);
        ProductCategory::create(['name' => 'Boy Shoes','cover'=>'shoes.jpg','status'=>true,'parent_id'=>$shoes->id]);
        ProductCategory::create(['name' => 'Girls Shoes','cover'=>'shoes.jpg','status'=>true,'parent_id'=>$shoes->id]);


        $watches = ProductCategory::create(['name' => 'Watches','cover'=>'watches.jpg','status'=>true,'parent_id'=>null]);
        ProductCategory::create(['name' => 'Men\'s watches','cover'=>'watches.jpg','status'=>true,'parent_id'=>$watches->id]);
        ProductCategory::create(['name' => 'Women\'s watches','cover'=>'watches.jpg','status'=>true,'parent_id'=>$watches->id]);
        ProductCategory::create(['name' => 'Boy watches','cover'=>'watches.jpg','status'=>true,'parent_id'=>$watches->id]);
        ProductCategory::create(['name' => 'Girls watches','cover'=>'watches.jpg','status'=>true,'parent_id'=>$watches->id]);


        $electronics = ProductCategory::create(['name' => 'Electronics','cover'=>'electronics.jpg','status'=>true,'parent_id'=>null]);
        ProductCategory::create(['name' => 'Mobile\'s','cover'=>'electronics.jpg','status'=>true,'parent_id'=>$electronics->id]);
        ProductCategory::create(['name' => 'labtop\'s ','cover'=>'electronics.jpg','status'=>true,'parent_id'=>$electronics->id]);
        ProductCategory::create(['name' => 'Screen\'s','cover'=>'electronics.jpg','status'=>true,'parent_id'=>$electronics->id]);
        ProductCategory::create(['name' => 'Tv','cover'=>'electronics.jpg','status'=>true,'parent_id'=>$electronics->id]);

    }
}
