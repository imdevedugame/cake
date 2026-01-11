@extends('layouts.app_public')

@section('title','Contact')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-20 text-center">
  <h1 class="text-4xl font-bold latte-title mb-6">Kontak Kami</h1>
  <p class="text-[#6b5a48] mb-8">Untuk pemesanan, pertanyaan produk, atau kerja sama — silakan hubungi kami melalui WhatsApp.</p>

  <a href="https://wa.me/6282137758554" target="_blank" class="btn-latte px-10 py-4 rounded-full text-xl inline-block">Hubungi via WhatsApp</a>

  <div class="mt-12 card-latte p-8 rounded-xl mx-auto text-left">
    <h2 class="text-2xl font-semibold latte-title mb-4">Informasi Toko</h2>

    <ul class="text-[#4B3A2E] space-y-3">
      <li><strong class="text-latte">Alamat:</strong> Jl. Cakrawala No.15, Kota Semarang</li>
      <li><strong class="text-latte">Email:</strong> info@cakendessert.com</li>
      <li><strong class="text-latte">Telepon:</strong> 0812-2318-1585</li>
    </ul>
  </div>
</div>
@endsection
