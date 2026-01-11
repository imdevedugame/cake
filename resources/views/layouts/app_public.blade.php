<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />

  <title>@yield('title', 'Cake & Dessert')</title>

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>
<body class="antialiased bg-[#FFF7ED]">

{{-- ================= NAVBAR ================= --}}
<header class="nav-latte fixed top-0 left-0 w-full z-[999] bg-white/95 backdrop-blur">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    {{-- LOGO --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3">
      <div class="text-3xl">🍰</div>
      <div class="text-lg font-bold latte-title">Cake & Dessert</div>
    </a>

    {{-- NAV --}}
    <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('products.index') }}">Products</a>
      <a href="{{ route('discounts.index') }}">Discounts</a>
      <a href="{{ route('contact') }}">Contact</a>
      <a href="{{ route('about') }}">About</a>

      @auth
        @if(auth()->user()->role === 'admin')
          <a href="{{ route('admin.products.index') }}" class="font-semibold">
            Admin Panel
          </a>
        @endif
      @else
        <button onclick="openAdminLogin()" class="font-semibold">
          Admin
        </button>
      @endauth
    </nav>
  </div>
</header>

{{-- ================= PAGE CONTENT ================= --}}
<main class="min-h-screen pt-24">
  @yield('content')
</main>

{{-- ================= FOOTER ================= --}}
<footer class="footer-latte mt-20">
  <div class="max-w-7xl mx-auto px-6 py-12 text-center">
    <h3 class="text-xl font-semibold latte-title">Cake & Dessert</h3>
    <p class="text-sm">© {{ date('Y') }} Cake & Dessert</p>
  </div>
</footer>

{{-- ================= ADMIN LOGIN MODAL ================= --}}
<div id="adminLoginModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-[1000]">

  <div id="adminModalBox"
       class="bg-white rounded-2xl w-full max-w-sm p-8
              transform scale-95 opacity-0 transition-all duration-300 relative">

    <button onclick="closeAdminLogin()" class="absolute top-4 right-4">✕</button>

    <h2 class="text-2xl font-semibold latte-title mb-6 text-center">
      Admin Login
    </h2>

    <form method="POST" action="/login">
      @csrf
      <input type="hidden" name="force_admin" value="1">

      <input type="email" name="email" required
             placeholder="Admin Email"
             class="w-full border rounded-lg px-4 py-2 mb-4">

      <input type="password" name="password" required
             placeholder="Password"
             class="w-full border rounded-lg px-4 py-2 mb-4">

      <input type="password" name="admin_key" required
             placeholder="Secret Key"
             class="w-full border rounded-lg px-4 py-2 mb-6">

      <button type="submit"
              class="w-full bg-[#6b5a48] text-white py-2 rounded-full">
        Login
      </button>
    </form>
  </div>
</div>

<script>
function openAdminLogin() {
  const modal = document.getElementById('adminLoginModal');
  const box = document.getElementById('adminModalBox');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  setTimeout(() => {
    box.classList.remove('scale-95','opacity-0');
  }, 50);
}

function closeAdminLogin() {
  const modal = document.getElementById('adminLoginModal');
  const box = document.getElementById('adminModalBox');
  box.classList.add('scale-95','opacity-0');
  setTimeout(() => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }, 200);
}
</script>

</body>
</html>
