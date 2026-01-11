@extends('layouts.app_public')

@section('title','INI PRODUK BUKAN HOME')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden">

  <div class="h-[420px] w-full relative">
    <img
      src="{{ asset('images/banner/products-banner.jpg') }}"
      class="absolute w-full h-full object-cover scale-105"
      alt="Our Desserts">

    <div class="absolute inset-0 bg-gradient-to-br
      from-[#3b2a1f]/80 via-[#6b4f3a]/70 to-[#2f1e14]/80"></div>
  </div>

  <div class="absolute inset-0 flex flex-col items-center justify-center
              text-center px-6 text-white z-10">

    <span class="uppercase tracking-[0.3em] text-sm mb-4">
      Signature Collection
    </span>

    <h1 class="text-4xl md:text-6xl latte-title mb-6">
      Our Dessert Collection
    </h1>

    <p class="max-w-xl text-white/90 text-lg leading-relaxed">
      A curated selection of handcrafted desserts, created with care,
      elegance, and a passion for timeless flavors.
    </p>

  </div>

</section>

{{-- BRAND STORY --}}
<section class="bg-white">
  <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-16 items-center">

    <div>
      <h2 class="text-3xl font-semibold latte-title mb-4">
        Crafted with Love & Precision
      </h2>
      <p class="text-[#6b5a48] leading-relaxed mb-6">
        Every dessert is thoughtfully prepared using premium ingredients,
        focusing on balanced flavors and elegant presentation.
        Our creations are designed not just to be tasted, but to be remembered.
      </p>
      <p class="text-[#8a7762]">
        Perfect for celebrations, meaningful moments, or simply indulging
        in something beautifully made.
      </p>
    </div>

    <div class="grid grid-cols-2 gap-6">
      <div class="bg-[#FFF7ED] p-6 rounded-xl text-center">
        <h3 class="text-2xl font-semibold text-[#6b5a48]">100%</h3>
        <p class="text-sm text-[#8a7762] mt-1">Handcrafted</p>
      </div>
      <div class="bg-[#FFF7ED] p-6 rounded-xl text-center">
        <h3 class="text-2xl font-semibold text-[#6b5a48]">Premium</h3>
        <p class="text-sm text-[#8a7762] mt-1">Ingredients</p>
      </div>
      <div class="bg-[#FFF7ED] p-6 rounded-xl text-center">
        <h3 class="text-2xl font-semibold text-[#6b5a48]">Elegant</h3>
        <p class="text-sm text-[#8a7762] mt-1">Presentation</p>
      </div>
      <div class="bg-[#FFF7ED] p-6 rounded-xl text-center">
        <h3 class="text-2xl font-semibold text-[#6b5a48]">Custom</h3>
        <p class="text-sm text-[#8a7762] mt-1">Made with Care</p>
      </div>
    </div>

  </div>
</section>

{{-- FILTER + SEARCH --}}
<section class="bg-[#FFF1E4]">
  <div class="max-w-7xl mx-auto px-6 py-16 text-center space-y-8">

    {{-- SEARCH --}}
    <div class="relative w-full max-w-2xl mx-auto">
  
  {{-- ICON SEARCH --}}
  <span
    class="absolute left-5 top-1/2 -translate-y-1/2
           text-[#a89580] transition
           pointer-events-none
           group-focus-within:text-[#6b5a48]">
    <!-- icon search (svg, ringan & no lib) -->
    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-4 w-4"
         fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
    </svg>
  </span>

  {{-- INPUT --}}
  <input
    id="searchInput"
    type="text"
    placeholder="Search cakes & desserts..."
    class="group w-full
           pl-12 pr-6 py-2
           rounded-full
           border border-[#d6c3ad]
           bg-[#FFF7ED]
           text-[#6b5a48]
           placeholder-[#a89580]
           focus:outline-none
           focus:border-[#6b5a48]
           focus:ring-1
           focus:ring-[#6b5a48]
           transition-all duration-300
           ease-in-out
           focus:shadow-md"
  >
</div>



    {{-- CATEGORY FILTER --}}
    <div class="flex flex-wrap justify-center gap-3">
      <button data-filter="all"
        class="filter-btn active px-6 py-2 rounded-full bg-[#6b5a48] text-white text-sm">
        All
      </button>

      @foreach($categories as $category)
        <button
          data-filter="{{ Str::slug($category->name) }}"
          class="filter-btn px-6 py-2 rounded-full border border-[#6b5a48]
                 text-[#6b5a48] hover:bg-[#6b5a48] hover:text-white transition text-sm">
          {{ $category->name }}
        </button>
      @endforeach
    </div>
  </div>
</section>

{{-- ================= DISCOUNT PRODUCTS ================= --}}
@if(isset($discountProducts) && $discountProducts->count())
<section class="mb-28">

  {{-- TITLE --}}
  <div class="text-center mb-12">
    <h2 class="text-3xl latte-title mb-3">
      🔥 Promo Spesial
    </h2>
    <p class="text-[#8a7762] text-sm">
      Penawaran terbatas untuk dessert favorit pilihan kami
    </p>
  </div>

  {{-- PRODUCT GRID --}}
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">
    @foreach($discountProducts->take(4) as $product)

      <a href="{{ route('product.show', $product->slug) }}"
         class="group bg-white rounded-2xl shadow-lg overflow-hidden
                hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 relative">

        {{-- BADGE --}}
        @if($product->discount_percent_label)
          <span class="absolute top-4 left-4 bg-red-600 text-white
                       text-xs font-semibold px-3 py-1 rounded-full z-10">
            -{{ $product->discount_percent_label }}%
          </span>
        @endif

        {{-- IMAGE --}}
        <img
          src="{{ asset('storage/products/'.$product->image) }}"
          class="h-56 w-full object-cover
                 group-hover:scale-105 transition duration-500">

        {{-- CONTENT --}}
        <div class="p-5">
          <h3 class="font-semibold text-[#3c2f28] mb-2">
            {{ $product->name }}
          </h3>

          <div class="flex items-center gap-2">
            <span class="text-red-600 font-bold">
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

  {{-- 🔥 BUTTON LIHAT SEMUA --}}
  @if(isset($activeDiscount))
  <div class="flex justify-center">
    <a href="{{ route('discounts.show', $activeDiscount->slug) }}"
       class="group inline-flex items-center gap-3
              px-10 py-4 rounded-full
              bg-[#6b5a48] text-white
              text-sm tracking-widest uppercase
              shadow-lg
              hover:bg-[#5a483a]
              hover:shadow-2xl
              hover:-translate-y-1
              transition-all duration-300">

      <span>Lihat Selengkapnya</span>

      {{-- ICON ARROW --}}
      <svg xmlns="http://www.w3.org/2000/svg"
           class="h-4 w-4 transform
                  group-hover:translate-x-1
                  transition-transform duration-300"
           fill="none" viewBox="0 0 24 24"
           stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 5l7 7-7 7" />
      </svg>
    </a>
  </div>
  @endif

</section>
@endif

{{-- PRODUCTS --}}
<section class="bg-[#FFF1E4]">
  <div class="max-w-7xl mx-auto px-6 pb-28">

    @foreach($categories as $category)
      @if($category->products->count())

        <div class="product-group mb-32"
             data-category="{{ Str::slug($category->name) }}">

          <h2 class="text-3xl font-semibold text-[#6b5a48] mb-10">
            {{ $category->name }}
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

            @foreach($category->products as $product)
              <a href="{{ route('product.show', $product->slug) }}"
                 class="product-item group relative"
                 data-name="{{ strtolower($product->name) }}">

                <div class="bg-white rounded-xl overflow-hidden
                            transition transform group-hover:-translate-y-2
                            group-hover:shadow-2xl relative">

                  {{-- BADGE DISKON --}}
                  @if($product->discount_percent_label)
                    <span class="absolute top-4 left-4 bg-red-600 text-white
                                 text-xs font-semibold px-3 py-1 rounded-full z-10">
                      -{{ $product->discount_percent_label }}%
                    </span>
                  @endif

                  {{-- IMAGE --}}
                  @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}"
                         class="w-full h-56 object-cover">
                  @endif

                  {{-- CONTENT --}}
                  <div class="p-5">
                    <h3 class="text-lg font-medium text-[#6b5a48] mb-2">
                      {{ $product->name }}
                    </h3>

                    {{-- PRICE --}}
                    <div class="flex items-center gap-2">
                      <span class="text-red-600 font-bold">
                        Rp {{ number_format($product->final_price) }}
                      </span>

                      @if($product->final_price < $product->price)
                        <span class="text-sm line-through text-gray-400">
                          Rp {{ number_format($product->price) }}
                        </span>
                      @endif
                    </div>
                  </div>

                </div>

              </a>
            @endforeach

          </div>

        </div>

      @endif
    @endforeach

  </div>
</section>

{{-- FILTER + SEARCH SCRIPT --}}
<script>
  const buttons = document.querySelectorAll('.filter-btn');
  const groups = document.querySelectorAll('.product-group');
  const searchInput = document.getElementById('searchInput');

  let activeCategory = 'all';

  function filterProducts() {
    const keyword = searchInput.value.toLowerCase();

    groups.forEach(group => {
      const categoryMatch =
        activeCategory === 'all' ||
        group.dataset.category === activeCategory;

      let hasVisibleProduct = false;

      group.querySelectorAll('.product-item').forEach(item => {
        const name = item.dataset.name;
        const match = name.includes(keyword);

        item.style.display = match ? 'block' : 'none';
        if (match) hasVisibleProduct = true;
      });

      group.style.display =
        categoryMatch && hasVisibleProduct ? 'block' : 'none';
    });
  }

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      buttons.forEach(b => b.classList.remove('bg-[#6b5a48]','text-white'));
      btn.classList.add('bg-[#6b5a48]','text-white');

      activeCategory = btn.dataset.filter;
      filterProducts();
    });
  });

  searchInput.addEventListener('input', filterProducts);
</script>

@endsection
