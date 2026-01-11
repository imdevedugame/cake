@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

<form action="{{ route('admin.products.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    {{-- NAMA --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Produk</label>
        <input type="text"
               name="name"
               value="{{ old('name', $product->name) }}"
               class="w-full border p-2 rounded"
               required>
    </div>

    {{-- KATEGORI --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Kategori</label>
        <select name="category_id"
                class="w-full border p-2 rounded"
                required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- 🔥 DISCOUNT / PROMO --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Promo / Discount</label>
        <select name="discount_id"
                class="w-full border p-2 rounded">
            <option value="">-- Tidak Ada Promo --</option>
            @foreach ($discounts as $discount)
                <option value="{{ $discount->id }}"
                    {{ $product->discount_id == $discount->id ? 'selected' : '' }}>
                    {{ $discount->title }}
                </option>
            @endforeach
        </select>
        <p class="text-sm text-gray-500 mt-1">
            Pilih promo agar produk muncul di halaman Discounts
        </p>
    </div>

    {{-- HARGA --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Harga Normal</label>
        <input type="number"
               name="price"
               value="{{ old('price', $product->price) }}"
               class="w-full border p-2 rounded"
               required>
    </div>

    {{-- HARGA DISKON --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Harga Diskon (Opsional)</label>
        <input type="number"
               name="discount_price"
               value="{{ old('discount_price', $product->discount_price) }}"
               class="w-full border p-2 rounded">
        <p class="text-sm text-gray-500 mt-1">
            Kosongkan jika tidak ada potongan harga
        </p>
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="description"
                  class="w-full border p-2 rounded"
                  rows="4">{{ old('description', $product->description) }}</textarea>
    </div>

    {{-- FEATURED --}}
    <div class="mb-4">
        <label class="flex items-center gap-2">
            <input type="checkbox"
                   name="is_featured"
                   value="1"
                   {{ $product->is_featured ? 'checked' : '' }}>
            <span class="font-semibold">Jadikan Featured?</span>
        </label>
    </div>

    {{-- GAMBAR --}}
    @if ($product->image)
        <div class="mb-4">
            <p class="font-semibold mb-1">Gambar Saat Ini</p>
            <img src="{{ asset('storage/products/' . $product->image) }}"
                 class="w-40 h-40 object-cover rounded border">
        </div>
    @endif

    <div class="mb-6">
        <label class="block font-semibold mb-1">Upload Gambar Baru</label>
        <input type="file"
               name="image"
               class="w-full border p-2 rounded">
        <p class="text-gray-500 text-sm">
            Kosongkan jika tidak ingin mengganti gambar
        </p>
    </div>

    {{-- ACTION --}}
    <button type="submit" class="btn-admin-latte">
        Update Produk
    </button>

    <a href="{{ route('admin.products.index') }}"
       class="ml-3 text-gray-600 hover:underline">
        Batal
    </a>
</form>
@endsection
