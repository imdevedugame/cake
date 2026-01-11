<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    // =========================
    // PRODUCT LIST PAGE
    // =========================
    public function index()
    {
        // ambil semua kategori + produk
        $categories = Category::with('products')->get();

        // ambil produk yang sedang diskon & MASIH AKTIF
        $discountProducts = Product::whereNotNull('discount_price')
            ->whereHas('discount', function ($q) {
                $today = Carbon::today();
                $q->where('start_date', '<=', $today)
                  ->where('end_date', '>=', $today);
            })
            ->get();

        return view('products.index', compact(
            'categories',
            'discountProducts'
        ));
    }

    // =========================
    // PRODUCT DETAIL
    // =========================
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }
}
