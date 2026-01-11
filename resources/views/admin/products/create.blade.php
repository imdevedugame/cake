@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
    @csrf

    <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Produk</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    {{-- ✅ KATEGORI (TAMBAHAN) --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Kategori</label>
        <select name="category_id" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- DISCOUNT --}}
<div class="mb-6">
  <label class="block font-medium mb-2">
    Promo / Discount (Opsional)
  </label>

  <select name="discount_id"
          class="w-full border rounded-lg px-4 py-2">
    <option value="">-- Tidak Ada Promo --</option>

    @foreach($discounts as $discount)
      <option value="{{ $discount->id }}">
        {{ $discount->title }}
      </option>
    @endforeach
  </select>
</div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Harga</label>
        <input type="number" name="price" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Harga Diskon (Opsional)</label>
        <input type="number" name="discount_price" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="description" class="w-full border p-2 rounded" rows="4"></textarea>
    </div>

    <div class="mb-4">
        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_featured" value="1">
            <span class="font-semibold">Jadikan Featured?</span>
        </label>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Gambar Produk</label>
        <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
    </div>

    <button type="submit" class="btn-admin-latte">Simpan</button>
    <a href="{{ route('admin.products.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
