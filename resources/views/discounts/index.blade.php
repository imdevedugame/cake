@extends('layouts.app_public')

@section('title', 'Discounts')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden mb-14">
  <div class="h-[420px] w-full relative">
    <img
      src="{{ asset('storage/banners/diskon.jpeg') }}"
      class="absolute w-full h-full object-cover scale-105"
      alt="Seasonal Discounts">

    <div class="absolute inset-0 bg-gradient-to-br
      from-[#3b0a0a]/80 via-[#8a2e2e]/70 to-[#0f3d2e]/80"></div>
  </div>

  {{-- ❄️ SNOW EFFECT --}}
  <div class="snow pointer-events-none"></div>


  <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 text-white z-10">
    <span class="uppercase tracking-[0.3em] text-sm mb-4">
      Seasonal Promotion
    </span>

    <h1 class="text-4xl md:text-6xl latte-title mb-6">
      Festive Seasonal Discounts
    </h1>

    <p class="max-w-xl text-white/90 text-lg leading-relaxed">
      Discover limited-time dessert offers crafted to celebrate
      meaningful moments.
    </p>
  </div>
</section>

{{-- ================= PROMO LIST ================= --}}
<section class="max-w-6xl mx-auto px-6 py-24 text-center">
  <h2 class="text-4xl latte-title mb-16">
    Current Promotions
  </h2>

  @if($discounts->count())
    <div class="flex justify-center">
      <div class="grid gap-12
                  grid-cols-1
                  md:grid-cols-2
                  lg:grid-cols-3
                  place-items-center">

                  @foreach($discounts as $discount)
  <a href="{{ route('discounts.show', $discount->slug) }}"
     class="group relative w-[340px]">

    <div class="relative overflow-hidden rounded-3xl shadow-xl
                group-hover:scale-105 transition duration-500">

      {{-- BADGE STATUS --}}
      @if($discount->isActive())
        <span class="absolute top-4 left-4 bg-red-600 text-white
                     text-xs font-semibold px-3 py-1 rounded-full z-20">
          {{ $discount->percent }}% OFF
        </span>

      @elseif(now()->lt($discount->start_date))
        <span class="absolute top-4 left-4 bg-yellow-500 text-white
                     text-xs font-semibold px-3 py-1 rounded-full z-20 animate-pulse">
          Coming Soon
        </span>

      @elseif(now()->gt($discount->end_date))
        <span class="absolute top-4 left-4 bg-gray-400 text-white
                     text-xs font-semibold px-3 py-1 rounded-full z-20">
          Expired
        </span>
      @endif

      <img
        src="{{ asset('storage/discounts/'.$discount->banner_image) }}"
        class="w-full h-[420px] object-cover">

      <div class="absolute inset-0 bg-black/40"></div>

      <div class="absolute inset-0 flex flex-col
                  justify-center items-center text-white px-6 text-center">
        <span class="text-xs tracking-widest mb-2">
          LIMITED OFFER
        </span>

        <h3 class="text-2xl font-semibold mb-2">
          {{ $discount->title }}
        </h3>

        <p class="text-sm opacity-90">
          {{ $discount->description }}
        </p>
      </div>
    </div>

  </a>
@endforeach

      </div>
    </div>
  @else
    <p class="text-gray-500">
      No promotions available.
    </p>
  @endif

  {{-- BADGE STATUS --}}
@if($discount->isActive())
  <span class="absolute top-4 left-4 bg-red-600 text-white
               text-xs font-semibold px-3 py-1 rounded-full z-10">
    {{ $discount->percent }}% OFF
  </span>

@elseif($discount->isComingSoon())
  <span class="absolute top-4 left-4 bg-yellow-500 text-white
               text-xs font-semibold px-3 py-1 rounded-full z-10 animate-pulse">
    Coming Soon
  </span>

@elseif($discount->isExpired())
  <span class="absolute top-4 left-4 bg-gray-400 text-white
               text-xs font-semibold px-3 py-1 rounded-full z-10">
    Expired
  </span>
@endif


</section>

