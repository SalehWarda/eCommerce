<?php

namespace Database\Seeders;

use App\Models\ProductCoupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\True_;

class ProductCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        ProductCoupon::create([

            'code' => 'SALEH98',
            'type' => 'fixed',
            'value' => 500,
            'description' => 'Discount 500 SAR on your sales on website',
            'status' => true,
            'use_times' => 20,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addMonth(),
            'greater_than' => 600,


        ]);

        ProductCoupon::create([

            'code' => 'SALEH',
            'type' => 'percentage',
            'value' => 50,
            'description' => 'Discount 50% SAR on your sales on website',
            'status' => true,
            'use_times' => 10,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addWeek(),
            'greater_than' => null,


        ]);


    }
}
