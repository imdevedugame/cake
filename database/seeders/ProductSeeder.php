<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Chocolate Cake',
            'slug' => Str::slug('Chocolate Cake'),
            'description' => 'Kue coklat lembut dengan topping premium.',
            'price' => 75000,
            'is_featured' => true,
            'image' => null,
        ]);
    }
}
