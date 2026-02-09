<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'sku' => 'SKU-' . $i,
                'price' => rand(100, 500),
                'stock' => rand(5, 50),
                'is_active' => 1,
            ]);
        }

    }
}
