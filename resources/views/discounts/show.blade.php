@extends('layouts.app_public')

@section('title', $discount->title)

@section('content')
<div class="bg-[#FFF7ED] min-h-screen">

{{-- HERO / BANNER --}}
<section class="relative overflow-hidden mt-[30px]">
  <div class="relative h-[420px] w-full">
    <img
      src="{{ asset('storage/discounts/'.$discount->banner_image) }}"
      class="absolute inset-0 w-full h-full object-cover"
      alt="{{ $discount->title }}">

    <div class="absolute inset-0 bg-black/45"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center
                text-center px-6 text-white">
      <span class="uppercase tracking-widest text-sm mb-3">
        Limited Offer
      </span>

      <h1 class="text-4xl md:text-6xl latte-title mb-4">
        {{ $discount->title }}
      </h1>

      <p class="max-w-xl text-white/90 text-lg">
        {{ $discount->description }}
      </p>
    </div>
  </div>
</section>

{{-- LIST PRODUK --}}
<section class="max-w-7xl mx-auto px-6 pt-20 pb-32">
  @if($products->count())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-12">

      @foreach($products as $product)

      <a href="{{ route('product.show', $product->slug) }}"
         class="group bg-white rounded-2xl shadow-lg overflow-hidden
                hover:-translate-y-1 hover:shadow-2xl transition relative">

        {{-- BADGE DISKON --}}
        @if($product->discount_percent_label)
          <span class="absolute top-4 left-4 bg-red-600 text-white
                       text-xs font-semibold px-3 py-1 rounded-full z-10">
            -{{ $product->discount_percent_label }}%
          </span>
        @endif

        {{-- IMAGE --}}
        <img
          src="{{ asset('storage/products/'.$product->image) }}"
          class="h-60 w-full object-cover group-hover:scale-105 transition duration-500">

        <div class="p-6">
          <h3 class="text-xl font-semibold mb-2 text-[#3c2f28]">
            {{ $product->name }}
          </h3>

          <p class="text-sm text-gray-600 mb-4">
            {{ Str::limit($product->description, 80) }}
          </p>

          {{-- PRICE --}}
          <div class="flex items-center gap-3">
            <span class="text-lg font-bold text-red-600">
              Rp {{ number_format($product->final_price) }}
            </span>

            @if($product->final_price < $product->price)
              <span class="text-sm line-through text-gray-400">
                Rp {{ number_format($product->price) }}
              </span>
            @endif
          </div>
        </div>

      </a>

      @endforeach

    </div>
  @else
    <p class="text-center text-gray-500">
      Belum ada produk untuk promo ini.
    </p>
  @endif
</section>

</div>
@endsection
