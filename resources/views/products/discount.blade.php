@extends('layouts.app_public')

@section('title','Discounts')

@php
  $month = now()->month;

  if ($month == 12) {
    $season = 'christmas';
    $seasonTitle = 'Christmas Celebration';
  } elseif ($month == 1) {
    $season = 'new_year';
    $seasonTitle = 'New Year Celebration';
  } else {
    $season = 'default';
    $seasonTitle = 'Seasonal Specials';
  }
@endphp

@section('content')

{{-- 🎄 FESTIVE HERO --}}
<section class="relative overflow-hidden mb-32">

  <div class="h-[460px] w-full relative">
    <img src="{{ asset('storage/banners/diskon.jpeg') }}"
         class="absolute w-full h-full object-cover scale-105">
    <div class="absolute inset-0 bg-gradient-to-br
                from-[#3b0a0a]/80 via-[#8a2e2e]/70 to-[#0f3d2e]/80"></div>
  </div>

  <div class="absolute inset-0 pointer-events-none snow"></div>

  <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 text-white z-10">
    <span class="uppercase tracking-[0.3em] text-sm mb-4">
      {{ $seasonTitle }}
    </span>

    <h1 class="text-4xl md:text-6xl latte-title mb-6">
      Festive Seasonal Discounts
    </h1>

    <p class="max-w-xl text-white/90 text-lg leading-relaxed">
      Discover our limited-time promotions crafted
      to celebrate moments that matter.
    </p>
  </div>
</section>

{{-- 🎁 PROMO BANNERS --}}
<section class="bg-[#FFF7ED] py-32">
  <div class="max-w-7xl mx-auto px-6">

    <h2 class="text-4xl latte-title text-center mb-20">
      Current Promotions
    </h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-14">

      @foreach($discounts as $discount)
        <a href="{{ route('discounts.show', $discount->slug) }}"
           class="group relative rounded-3xl overflow-hidden shadow-xl
                  hover:-translate-y-2 hover:shadow-2xl transition">

          <img src="{{ asset('storage/discounts/'.$discount->banner_image) }}"
               class="w-full h-80 object-cover group-hover:scale-105 transition duration-700">

          <div class="absolute inset-0 bg-black/40"></div>

          <div class="absolute inset-0 flex flex-col justify-center items-center
                      text-center px-8 text-white">
            <span class="uppercase tracking-widest text-sm mb-3">
              Limited Offer
            </span>

            <h3 class="text-3xl latte-title mb-3">
              {{ $discount->title }}
            </h3>

            <p class="text-sm opacity-90">
              {{ $discount->description }}
            </p>
          </div>

        </a>
      @endforeach

    </div>

  </div>
</section>

{{-- ⏱ COUNTDOWN --}}
<section class="max-w-5xl mx-auto px-6 mb-32">
  <div class="bg-white rounded-3xl shadow-xl py-14 px-6 text-center">

    <h2 class="text-3xl latte-title mb-4">
      Countdown to New Year
    </h2>

    <p class="text-[#6b5a48] mb-10">
      Celebrate the season with exclusive dessert creations.
    </p>

    <div id="countdown" class="grid grid-cols-2 sm:grid-cols-4 gap-6 max-w-3xl mx-auto">

      @foreach(['Days','Hours','Minutes','Seconds'] as $label)
        <div class="bg-[#FFF7ED] rounded-2xl py-6 shadow">
          <div id="{{ strtolower($label) }}"
               class="text-4xl font-bold text-[#6b5a48]">00</div>
          <div class="text-sm text-[#8a7762] mt-1">{{ $label }}</div>
        </div>
      @endforeach

    </div>
  </div>
</section>

{{-- ❄️ SNOW EFFECT --}}
<style>
.snow::before,
.snow::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image:
    radial-gradient(2px 2px at 20px 30px, white, transparent),
    radial-gradient(2px 2px at 100px 80px, white, transparent),
    radial-gradient(2px 2px at 200px 150px, white, transparent);
  animation: snow 18s linear infinite;
  opacity: 0.6;
}
.snow::after {
  animation-duration: 25s;
  opacity: 0.4;
}
@keyframes snow {
  0% { transform: translateY(-100px); }
  100% { transform: translateY(600px); }
}
</style>

{{-- ⏱ COUNTDOWN SCRIPT --}}
<script>
  const targetDate = new Date(new Date().getFullYear() + 1, 0, 1).getTime();
  setInterval(() => {
    const now = new Date().getTime();
    const d = targetDate - now;
    if (d < 0) return;

    days.innerText = Math.floor(d / (1000 * 60 * 60 * 24));
    hours.innerText = Math.floor((d / (1000 * 60 * 60)) % 24);
    minutes.innerText = Math.floor((d / (1000 * 60)) % 60);
    seconds.innerText = Math.floor((d / 1000) % 60);
  }, 1000);
</script>

@endsection
