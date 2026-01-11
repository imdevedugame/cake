<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;
use Illuminate\Support\Str;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        Discount::create([
            'title' => 'New Year Special',
            'slug' => Str::slug('New Year Special'),
            'description' => 'Celebrate the New Year with exclusive dessert discounts',
            'banner_image' => 'new_year.jpg',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
        ]);

        Discount::create([
            'title' => 'Valentine Sweet Deals',
            'slug' => Str::slug('Valentine Sweet Deals'),
            'description' => 'Special treats crafted with love for Valentine’s season',
            'banner_image' => 'valentine.jpg',
            'start_date' => now()->addDays(30),
            'end_date' => now()->addDays(37),
        ]);
    }
}
