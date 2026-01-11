@extends('layouts.app_public')

@section('title','About Us')

@section('content')

{{-- HERO BANNER --}}
<section class="relative overflow-hidden">
  <div class="h-[420px] w-full relative">
    <img
      src="{{ asset('images/about-banner.jpg') }}"
      class="absolute w-full h-full object-cover scale-105"
      alt="About Cake & Dessert">

    {{-- overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br
        from-[#3b2a1f]/80 via-[#6b4a35]/70 to-[#2b1a10]/80"></div>
  </div>

  <div class="absolute inset-0 flex flex-col items-center justify-center
              text-center px-6 text-white z-10">

    <span class="uppercase tracking-[0.35em] text-xs mb-4 opacity-90">
      About Us
    </span>

    <h1 class="text-4xl md:text-6xl latte-title mb-6">
      Cake & Dessert
    </h1>

    <p class="max-w-xl text-white/90 text-lg leading-relaxed">
      Handcrafted desserts made with passion,
      elegance, and a love for timeless flavors.
    </p>
  </div>
</section>


{{-- STORY --}}
<section class="bg-white">
  <div class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-20 items-center">

    {{-- TEXT --}}
    <div class="fade-up">
      <h2 class="text-3xl latte-title mb-6">
        Crafted with Passion
      </h2>

      <p class="text-[#6b5a48] leading-relaxed mb-5">
        Cake & Dessert was born from a simple idea:
        to create desserts that feel personal, elegant,
        and made with genuine care.
      </p>

      <p class="text-[#6b5a48] leading-relaxed mb-5">
        Every cake we make is handcrafted in small batches,
        using premium ingredients and refined techniques
        to ensure consistent quality and beautiful presentation.
      </p>

      <p class="text-[#8a7762]">
        We believe desserts should not only taste good,
        but also tell a story and elevate every celebration.
      </p>
    </div>

    {{-- IMAGE --}}
<div class="relative flex justify-center">
  <img
    src="{{ asset('storage/banners/banner1.jpeg') }}"
    alt="About Cake & Dessert"
    class="w-[85%] max-w-md
           aspect-[4/5]
           object-cover
           rounded-3xl
           shadow-xl">
</div>


  </div>
</section>

{{-- VALUES --}}
<section class="bg-[#FFF1E4]">
  <div class="max-w-7xl mx-auto px-6 py-28">

    <h2 class="text-4xl latte-title text-center mb-16 fade-up">
      Our Promise
    </h2>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">

      <div class="bg-white rounded-2xl p-8 text-center shadow-md fade-up">
        <h3 class="text-xl font-semibold text-[#6b5a48] mb-2">
          Handcrafted
        </h3>
        <p class="text-sm text-[#8a7762]">
          Every dessert is made by hand
          with attention to detail.
        </p>
      </div>

      <div class="bg-white rounded-2xl p-8 text-center shadow-md fade-up">
        <h3 class="text-xl font-semibold text-[#6b5a48] mb-2">
          Premium Quality
        </h3>
        <p class="text-sm text-[#8a7762]">
          Only carefully selected ingredients
          make it into our kitchen.
        </p>
      </div>

      <div class="bg-white rounded-2xl p-8 text-center shadow-md fade-up">
        <h3 class="text-xl font-semibold text-[#6b5a48] mb-2">
          Elegant Design
        </h3>
        <p class="text-sm text-[#8a7762]">
          Aesthetic presentation crafted
          to elevate every occasion.
        </p>
      </div>

      <div class="bg-white rounded-2xl p-8 text-center shadow-md fade-up">
        <h3 class="text-xl font-semibold text-[#6b5a48] mb-2">
          Personal Touch
        </h3>
        <p class="text-sm text-[#8a7762]">
          Customized desserts made
          for meaningful moments.
        </p>
      </div>

    </div>
  </div>
</section>

{{-- CTA --}}
<section class="bg-[#6b5a48] text-white">
  <div class="max-w-7xl mx-auto px-6 py-24 text-center fade-up">

    <h2 class="text-4xl latte-title mb-6">
      Let Us Sweeten Your Moments
    </h2>

    <p class="max-w-2xl mx-auto text-white/80 mb-10">
      From intimate gatherings to special celebrations,
      we’re here to create desserts you’ll remember.
    </p>

    <a href="{{ route('products.index') }}"
       class="inline-block bg-white text-[#6b5a48]
              px-10 py-3 rounded-full font-semibold
              hover:bg-[#FFF1E4] transition">
      Explore Our Desserts
    </a>

  </div>
</section>

{{-- ANIMATION SCRIPT --}}
<script>
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
      }
    });
  }, { threshold: 0.15 });

  document.querySelectorAll('.fade-up').forEach(el => {
    observer.observe(el);
  });
</script>

{{-- ANIMATION STYLE --}}
<style>
  .fade-up {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s ease;
  }

  .fade-up.show {
    opacity: 1;
    transform: translateY(0);
  }
</style>

@endsection
