<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'name' => 'KFC BlackPink',
                'image' => 'uploads/kfc.png',
                'description' => 'Discount 20% when order 3 items',
                'config_coupon' => 10,
                'app_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'MC Donald BTS COMBO',
                'image' => 'uploads/mcdonald.png',
                'description' => 'Discount 25% when order 4 items',
                'config_coupon' => 10,
                'app_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lotte Anniversary',
                'image' => 'uploads/lotte.png',
                'description' => 'Discount 10% in total bill',
                'config_coupon' => 10,
                'app_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
