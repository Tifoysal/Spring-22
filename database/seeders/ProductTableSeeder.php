<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'=>'product 1',
                'category_id'=>1,
                'quantity'=>10,
                'price'=>20.0,
                'details'=>'test',
        ]);
        Product::create([
                'name'=>'product 1',
                'category_id'=>1,
                'quantity'=>10,
                'price'=>20.0,
                'details'=>'test',
        ]);
        
    }
}
