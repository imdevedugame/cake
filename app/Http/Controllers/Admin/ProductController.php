<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::with(['category', 'discount'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all(),
            'discounts'  => Discount::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'price'          => 'required|numeric',
            'category_id'    => 'required|exists:categories,id',
            'discount_id'    => 'nullable|exists:discounts,id',
            'discount_price' => 'nullable|numeric|lt:price',
            'description'    => 'nullable',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ AUTO UNIQUE SLUG
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $i = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        // ✅ IMAGE UPLOAD
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->storeAs('products', $imageName, 'public');
        }

        Product::create([
            'name'           => $request->name,
            'slug'           => $slug,
            'price'          => $request->price,
            'category_id'    => $request->category_id,
            'discount_id'    => $request->discount_id,
            'discount_price' => $request->discount_price,
            'description'    => $request->description,
            'image'          => $imageName,
            'is_featured'    => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('admin.products.edit', [
            'product'    => Product::findOrFail($id),
            'categories' => Category::all(),
            'discounts'  => Discount::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'           => 'required',
            'price'          => 'required|numeric',
            'category_id'    => 'required|exists:categories,id',
            'discount_id'    => 'nullable|exists:discounts,id',
            'discount_price' => 'nullable|numeric|lt:price',
            'description'    => 'nullable',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ AUTO UNIQUE SLUG (EDIT MODE)
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $i = 1;

        while (
            Product::where('slug', $slug)
                ->where('id', '!=', $product->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $i++;
        }

        // ✅ IMAGE UPDATE
        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/products/' . $product->image)) {
                Storage::delete('public/products/' . $product->image);
            }

            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->storeAs('products', $imageName, 'public');
            $product->image = $imageName;
        }

        $product->update([
            'name'           => $request->name,
            'slug'           => $slug,
            'price'          => $request->price,
            'category_id'    => $request->category_id,
            'discount_id'    => $request->discount_id,
            'discount_price' => $request->discount_price,
            'description'    => $request->description,
            'is_featured'    => $request->boolean('is_featured'),
            'image'          => $product->image,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::exists('public/products/' . $product->image)) {
            Storage::delete('public/products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
