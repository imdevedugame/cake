@extends('admin.layouts.app')

@section('title','Preview Discount')

@section('content')

<h1 class="text-2xl font-bold mb-4">
  {{ $discount->title }}
</h1>

<p class="text-gray-600 mb-8">
  {{ $discount->description }}
</p>

<h2 class="text-xl font-semibold mb-6">
  Produk dalam Promo ({{ $discount->percent }}%)
</h2>

@if($products->count())
  <div class="grid md:grid-cols-3 gap-8">

    @foreach($products as $product)
      <div class="bg-white rounded-xl shadow overflow-hidden relative">

        {{-- badge --}}
        <span class="absolute top-3 left-3 bg-red-600 text-white
                     text-xs px-3 py-1 rounded-full">
          -{{ $discount->percent }}%
        </span>

        <img
          src="{{ asset('storage/products/'.$product->image) }}"
          class="h-48 w-full object-cover">

        <div class="p-4">
          <h3 class="font-semibold mb-2">
            {{ $product->name }}
          </h3>

          <div class="flex gap-2 items-center">
            <span class="text-red-600 font-bold">
              Rp {{
                number_format(
                  $product->price - ($product->price * $discount->percent / 100)
                )
              }}
            </span>

            <span class="line-through text-sm text-gray-400">
              Rp {{ number_format($product->price) }}
            </span>
          </div>
        </div>

      </div>
    @endforeach

  </div>
@else
  <p class="text-gray-500">
    Belum ada produk di promo ini.
  </p>
@endif

@endsection
