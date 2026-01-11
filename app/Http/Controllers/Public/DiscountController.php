<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    /**
     * LIST DISCOUNT (PUBLIC)
     */
    public function index()
{
    $discounts = Discount::where('status', 'published')
        ->orderBy('start_date')
        ->get();

    return view('discounts.index', compact('discounts'));
}

    /**
     * DETAIL DISCOUNT
     */
    public function show($slug)
    {
        $discount = Discount::where('slug', $slug)
            ->where('status', 'published')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->firstOrFail();

        $products = $discount->products()->latest()->get();

        // 🔥 PRODUK YANG IKUT PROMO AKTIF
        $products = Product::where('discount_id', $discount->id)
            ->with('discount')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('discounts.show', compact('discount', 'products'));
    }
}
