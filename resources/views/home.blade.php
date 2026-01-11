@extends('layouts.app_public')

@section('title','Home')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden">
  <div class="h-[540px] md:h-[700px] w-full relative">
    <img src="{{ asset('storage/banners/home.jpg') }}"
         class="absolute w-full h-full object-cover">
    <div class="absolute inset-0 bg-[#fff7ed]/75"></div>
  </div>

  <div class="absolute inset-0 flex flex-col items-center justify-center text-center z-20 px-6">
    <h1 class="text-4xl md:text-6xl latte-title font-semibold text-[#3c2f28] leading-tight">
      Where Desserts<br class="hidden md:block">
      Meet Elegance
    </h1>

    <p class="mt-6 max-w-xl text-[#5c4b40] text-lg leading-relaxed">
      A carefully curated selection of desserts,
      designed to elevate meaningful moments.
    </p>

    <a href="{{ route('products.index') }}"
       class="mt-10 bg-[#6b5a48] text-white px-10 py-3 rounded-full
              hover:bg-[#5a4a3a] transition">
      View Our Collection
    </a>
  </div>
</section>

{{-- ================= CATEGORY SHOWCASE ================= --}}
<section class="max-w-7xl mx-auto px-6 py-28">

  <div class="text-center mb-20">
    <h2 class="text-3xl md:text-4xl latte-title mb-4">
      Crafted for Meaningful Moments
    </h2>
    <p class="max-w-2xl mx-auto text-[#6b5a48] leading-relaxed">
      Each category is thoughtfully curated to suit different occasions,
      from intimate treats to elegant celebrations.
    </p>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mt-16">

  {{-- CUPCAKE --}}
  <a href="{{ route('products.index', ['category' => 'cupcake']) }}"
     class="group text-center block">

    <div class="bg-white/70 backdrop-blur
                rounded-3xl p-4
                border border-[#e7d8c7]
                shadow-md
                transition-all duration-500
                group-hover:-translate-y-3
                group-hover:shadow-2xl">

      <div class="overflow-hidden rounded-2xl">
        <img src="{{ asset('storage/banners/cupcake.jpeg') }}"
             class="h-60 w-full object-cover transition-transform duration-700 group-hover:scale-110">
      </div>

      <h3 class="mt-6 text-xl font-semibold text-[#4b3a2e]">
        Cupcake
      </h3>

      <p class="text-sm text-[#8a7762] mt-1">
        Sweet treats for everyday indulgence
      </p>

    </div>
  </a>

  {{-- BIRTHDAY CAKE --}}
  <a href="{{ route('products.index', ['category' => 'birthday-cake']) }}"
     class="group text-center block">

    <div class="bg-white/70 backdrop-blur
                rounded-3xl p-4
                border border-[#e7d8c7]
                shadow-md
                transition-all duration-500
                group-hover:-translate-y-3
                group-hover:shadow-2xl">

      <div class="overflow-hidden rounded-2xl">
        <img src="{{ asset('storage/banners/birtdaycake.jpg') }}"
             class="h-60 w-full object-cover transition-transform duration-700 group-hover:scale-110">
      </div>

      <h3 class="mt-6 text-xl font-semibold text-[#4b3a2e]">
        Birthday Cake
      </h3>

      <p class="text-sm text-[#8a7762] mt-1">
        Designed for special celebrations
      </p>

    </div>
  </a>

  {{-- MACARONS --}}
  <a href="{{ route('products.index', ['category' => 'macarons']) }}"
     class="group text-center block">

    <div class="bg-white/70 backdrop-blur
                rounded-3xl p-4
                border border-[#e7d8c7]
                shadow-md
                transition-all duration-500
                group-hover:-translate-y-3
                group-hover:shadow-2xl">

      <div class="overflow-hidden rounded-2xl">
        <img src="{{ asset('storage/banners/macaroons.jpeg') }}"
             class="h-60 w-full object-cover transition-transform duration-700 group-hover:scale-110">
      </div>

      <h3 class="mt-6 text-xl font-semibold text-[#4b3a2e]">
        Macarons
      </h3>

      <p class="text-sm text-[#8a7762] mt-1">
        Delicate textures & refined flavors
      </p>

    </div>
  </a>

  {{-- DESSERT --}}
  <a href="{{ route('products.index', ['category' => 'dessert']) }}"
     class="group text-center block">

    <div class="bg-white/70 backdrop-blur
                rounded-3xl p-4
                border border-[#e7d8c7]
                shadow-md
                transition-all duration-500
                group-hover:-translate-y-3
                group-hover:shadow-2xl">

      <div class="overflow-hidden rounded-2xl">
        <img src="{{ asset('storage/banners/dessert.jpeg') }}"
             class="h-60 w-full object-cover transition-transform duration-700 group-hover:scale-110">
      </div>

      <h3 class="mt-6 text-xl font-semibold text-[#4b3a2e]">
        Dessert
      </h3>

      <p class="text-sm text-[#8a7762] mt-1">
        Elegant selections for every moment
      </p>

    </div>
  </a>

</div>


{{-- ================= FEATURED DISCOUNTS ================= --}}
<section class="bg-[#fff1e4] py-28">
  <div class="max-w-6xl mx-auto text-center px-6">

    <h2 class="text-3xl md:text-4xl latte-title mb-6">
      Seasonal Highlights
    </h2>

    <p class="max-w-2xl mx-auto text-[#6b5a48] leading-relaxed mb-12">
      Limited-time selections crafted to celebrate the season.
      Discover special creations available for a short time only.
    </p>

    {{-- 🔥 FIX ROUTE --}}
    <a href="{{ route('discounts.index') }}"
       class="inline-block bg-[#6b5a48] text-white px-12 py-4 rounded-full
              hover:bg-[#5a4a3a] transition text-lg">
      View Seasonal Offers
    </a>

  </div>
</section>

@endsection
