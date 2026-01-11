<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::latest()->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'description'  => 'nullable',
            'percent'      => 'required|numeric|min:0|max:100',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Auto-generate unique slug
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $i = 1;

        while (Discount::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        // Image upload
        $imageName = null;
        if ($request->hasFile('banner_image')) {
            $imageName = time() . '-' . $request->banner_image->getClientOriginalName();
            $request->banner_image->storeAs('discounts', $imageName, 'public');
        }

        Discount::create([
            'title'        => $request->title,
            'slug'         => $slug,
            'description'  => $request->description,
            'percent'      => $request->percent,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'banner_image' => $imageName,
            'status'       => $request->status ?? 'draft',
        ]);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    public function show(Discount $discount)
    {
        return view('admin.discounts.show', compact('discount'));
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'title'        => 'required',
            'description'  => 'nullable',
            'percent'      => 'required|numeric|min:0|max:100',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Auto-generate unique slug if title changed
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $i = 1;

        while (
            Discount::where('slug', $slug)
                ->where('id', '!=', $discount->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $i++;
        }

        // Image update
        if ($request->hasFile('banner_image')) {
            if ($discount->banner_image && Storage::exists('public/discounts/' . $discount->banner_image)) {
                Storage::delete('public/discounts/' . $discount->banner_image);
            }

            $imageName = time() . '-' . $request->banner_image->getClientOriginalName();
            $request->banner_image->storeAs('discounts', $imageName, 'public');
            $discount->banner_image = $imageName;
        }

        $discount->update([
            'title'        => $request->title,
            'slug'         => $slug,
            'description'  => $request->description,
            'percent'      => $request->percent,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'banner_image' => $discount->banner_image,
            'status'       => $request->status ?? $discount->status,
        ]);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Discount $discount)
    {
        // Delete associated image
        if ($discount->banner_image && Storage::exists('public/discounts/' . $discount->banner_image)) {
            Storage::delete('public/discounts/' . $discount->banner_image);
        }

        $discount->delete();

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Promo berhasil dihapus!');
    }

    public function preview(Discount $discount)
    {
        $products = $discount->products()->latest()->get();

        return view('discounts.show', [
            'discount' => $discount,
            'products' => $products,
            'isAdminPreview' => true,
        ]);
    }

    public function toggleStatus(Discount $discount)
    {
        $discount->update([
            'status' => $discount->status === 'published'
                ? 'draft'
                : 'published'
        ]);

        return back()->with('success', 'Status promo berhasil diubah');
    }

}
