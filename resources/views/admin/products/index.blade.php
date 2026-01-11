@extends('admin.layouts.app') 

@section('title', 'Daftar Produk')

@section('content')

<div x-data="{ open:false, deleteUrl:'' }">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-admin-latte">
            + Tambah Produk
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full border border-[#E8DCC9] rounded-lg overflow-hidden">
            <thead class="bg-[#F3E7D8] text-left">
                <tr>
                    <th class="p-3 border-b border-[#E8DCC9]">Gambar</th>
                    <th class="p-3 border-b border-[#E8DCC9]">Nama</th>
                    <th class="p-3 border-b border-[#E8DCC9]">Harga</th>
                    <th class="p-3 border-b border-[#E8DCC9]">Diskon</th>
                    <th class="p-3 border-b border-[#E8DCC9]">Featured?</th>
                    <th class="p-3 border-b border-[#E8DCC9]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="hover:bg-[#FFF6ED] transition">
                    <td class="border p-2">
                        @if ($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="w-20 h-20 object-cover rounded">
                        @else
                            <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="border p-2">{{ $product->name }}</td>
                    <td class="border p-2">Rp {{ number_format($product->price,0,',','.') }}</td>
                    <td class="border p-2">{{ $product->discount_price ? 'Rp '.number_format($product->discount_price,0,',','.') : '-' }}</td>
                    <td class="border p-2">
                        <span class="{{ $product->is_featured ? 'text-green-600 font-semibold' : 'text-gray-500' }}">
                            {{ $product->is_featured ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                    <td class="border p-2 flex gap-2">
                        {{-- Edit --}}
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-admin-latte bg-yellow-500 hover:bg-yellow-600">
                            Edit
                        </a>

                        {{-- Hapus --}}
                        <button 
                            @click="open=true; deleteUrl=`{{ route('admin.products.destroy', $product->id) }}`" 
                            class="btn-admin-latte bg-red-600 hover:bg-red-700">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    {{-- Modal Delete --}}
    <div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg border border-[#E8DCC9] p-6 w-96">
            <h2 class="text-2xl font-bold text-[#C8A27C] mb-3">Hapus Produk?</h2>
            <p class="text-[#7A6653] mb-5">Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end gap-3">
                <button @click="open=false" class="px-4 py-2 rounded bg-gray-400 hover:bg-gray-500 text-white">Batal</button>
                <form :action="deleteUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">Hapus</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
