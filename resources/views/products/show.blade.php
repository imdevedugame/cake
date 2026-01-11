@extends('layouts.app_public')

@section('title', $product->name)

@section('content')

<section class="bg-[#FFF7ED]">
  <div class="max-w-6xl mx-auto px-6 py-24">

    <div class="grid md:grid-cols-2 gap-16 items-center">

      {{-- IMAGE --}}
      <div class="flex justify-center md:justify-start relative">

        @if($product->discount_percent_label)
          <span class="absolute top-4 left-4 bg-red-600 text-white
                       text-xs font-semibold px-3 py-1 rounded-full z-10">
            -{{ $product->discount_percent_label }}%
          </span>
        @endif

        @if($product->image)
          <img
            src="{{ asset('storage/products/' . $product->image) }}"
            class="w-96 h-96 object-cover rounded-2xl shadow-xl"
            alt="{{ $product->name }}"
          >
        @else
          <div class="w-96 h-96 bg-[#F3E8D9] rounded-2xl flex items-center justify-center text-[#A08970]">
            No Image
          </div>
        @endif
      </div>

      {{-- CONTENT --}}
      <div>

        {{-- CATEGORY --}}
        @if($product->category)
          <span class="inline-block mb-6 px-5 py-2 rounded-full text-xs tracking-widest uppercase
                       bg-[#6b5a48] text-white">
            {{ $product->category->name }}
          </span>
        @endif

        {{-- TITLE --}}
        <h1 class="text-5xl font-semibold latte-title leading-tight mb-6">
          {{ $product->name }}
        </h1>

        <div class="w-20 h-[2px] bg-[#c9a27d] mb-6"></div>

        {{-- DESCRIPTION --}}
        <p class="text-[#6b5a48] text-lg leading-relaxed max-w-xl mb-10">
          {{ $product->description ?? 'A thoughtfully crafted dessert that combines delicate flavor, elegant presentation, and a comforting sweetness.' }}
        </p>

        {{-- FEATURES --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-14">
          <p class="text-sm text-[#6b5a48]">• Handcrafted using premium ingredients</p>
          <p class="text-sm text-[#6b5a48]">• Elegant design for celebrations</p>
          <p class="text-sm text-[#6b5a48]">• Soft texture & balanced sweetness</p>
          <p class="text-sm text-[#6b5a48]">• Customizable for special moments</p>
        </div>

        {{-- PRICE (SATU LOGIC DENGAN PRODUCTS & DISCOUNTS PAGE) --}}
        <div class="mb-10">
          @if($product->discount_percent_label)
            <div class="flex items-center gap-4">
              <span class="text-3xl font-bold text-red-600">
                Rp {{ number_format($product->final_price) }}
              </span>

              <span class="line-through text-gray-400 text-lg">
                Rp {{ number_format($product->price) }}
              </span>
            </div>
          @else
            <span class="text-3xl font-bold text-[#6b5a48]">
              Rp {{ number_format($product->price) }}
            </span>
          @endif
        </div>

        {{-- BACK --}}
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 text-sm tracking-wide text-[#6b5a48]
                  hover:text-[#a08970] transition">
          ← Back to Collection
        </a>

      </div>
    </div>

  </div>
</section>

@endsection
