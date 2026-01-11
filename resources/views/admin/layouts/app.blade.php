<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF8F0] text-[#4B3A2E]">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md border-b border-[#E8DCC9] px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-[#C8A27C] tracking-wide">
            Admin Panel
        </div>

        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="hover:text-[#C8A27C]">Public Site</a>
           <a href="{{ route('admin.discounts.index') }}">
  Discount Preview
</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 rounded bg-[#C8A27C] hover:bg-[#B8926E] text-white shadow">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- MAIN CONTENT WRAPPER --}}
    <div class="flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 min-h-screen bg-white border-r border-[#E8DCC9] p-6">
            <h2 class="text-lg font-semibold text-[#C8A27C] mb-4">Menu</h2>
            <ul class="space-y-3">
                <li><a href="{{ route('admin.products.index') }}" class="block p-2 rounded hover:bg-[#F3E7D8]">Produk</a></li>
                <li><a href="#" class="block p-2 rounded hover:bg-[#F3E7D8]">Pesanan</a></li>
                <li><a href="#" class="block p-2 rounded hover:bg-[#F3E7D8]">Lainnya</a></li>
            </ul>
        </aside>

        {{-- CONTENT --}}
        <main class="flex-1 p-10">
            @yield('content')
        </main>

    </div>

</body>
</html>
