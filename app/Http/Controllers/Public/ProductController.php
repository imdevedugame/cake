<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * PRODUCTS PAGE
     */

     public function index()
     {
         // kategori + produk normal
         $categories = Category::with('products')->get();
     
         // 🔥 DISCOUNT AKTIF & PUBLISHED
         $activeDiscount = Discount::where('status', 'published')
             ->where(function ($q) {
                 $now = now();
                 $q->whereNull('start_date')
                   ->orWhere('start_date', '<=', $now);
             })
             ->where(function ($q) {
                 $now = now();
                 $q->whereNull('end_date')
                   ->orWhere('end_date', '>=', $now);
             })
             ->latest()
             ->first();
     
         // 🔥 PRODUK PROMO = HANYA YANG BENERAN DISKON
         $discountProducts = collect();
     
         if ($activeDiscount) {
             $discountProducts = Product::where('discount_id', $activeDiscount->id)
                 ->whereHas('discount', function ($q) {
                     $q->where('status', 'published');
                 })
                 ->get();
         }
     
         return view('products.index', compact(
             'categories',
             'discountProducts',
             'activeDiscount'
         ));
     }     


    /**
     * PRODUCT DETAIL
     */
    public function show($slug)
    {
        $product = Product::with('discount')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
