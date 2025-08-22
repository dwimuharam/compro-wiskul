@extends('front.layouts.app')
@section('content')

{{-- Header --}}
<div id="header" class="bg-[#F6F7FA] relative h-[600px] -mb-[388px]">
  <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
    <x-navbar/>
  </div>
</div>

{{-- Shop Section --}}
<div id="ShopItems" class="w-full px-[10px] relative z-10">
  <div class="container max-w-[1130px] mx-auto flex flex-col gap-[50px] items-center">

    {{-- Breadcrumb + Heading --}}
    <div class="flex flex-col gap-[50px] items-center">
      <div class="breadcrumb flex items-center justify-center gap-[30px]">
        <p class="text-cp-light-grey">Home</p>
        <span class="text-cp-light-grey">/</span>
        <p class="text-cp-black font-semibold">Shop</p>
      </div>
      <h2 class="font-bold text-4xl leading-[45px] text-center">Discover Our Latest<br>Digital & Merch Items</h2>
    </div>

    {{-- Kategori Menu --}}
    <div class="flex gap-4 flex-wrap justify-center">
      @php
        $activeCategory = request('category');
      @endphp
      <a href="{{ route('front.shop') }}"
         class="px-5 py-2 rounded-full text-sm font-semibold transition
         {{ !$activeCategory ? 'text-cp-dark-blue' : 'text-cp-light-grey' }}">
        All
      </a>
      @foreach (['merchandise', 'ebook'] as $cat)
        <a href="{{ route('front.shop', ['category' => $cat]) }}"
          class="px-5 py-2 rounded-full text-sm font-semibold transition
          {{ $cat === $activeCategory ? 'text-cp-dark-blue' : 'text-cp-light-grey' }}">
          {{ ucfirst($cat) }}
        </a>
      @endforeach
    </div>

    {{-- Produk --}}
    <div class="shop-items-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px] justify-center w-full">
      @forelse($shopItems as $item)
        <a href="{{ route('front.shop.show', $item->id) }}" class="group">
          <div class="card bg-white flex flex-col justify-between h-full p-[30px] gap-[20px] rounded-[20px] border border-[#E8EAF2] group-hover:shadow-[0_10px_30px_0_#D1D4DF80] group-hover:border-cp-dark-blue transition-all duration-300">
            <div class="flex flex-col gap-[20px]">
              <div class="w-full h-[180px] rounded-[15px] overflow-hidden">
                <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->name }}" class="object-cover w-full h-full object-center transition-all duration-300 group-hover:scale-105">
              </div>
              <div class="flex flex-col gap-1">
                <p class="font-bold text-lg leading-[26px] text-cp-black">{{ $item->name }}</p>
                <p class="text-sm text-cp-light-grey capitalize">{{ $item->category }}</p>
                <p class="text-cp-dark-blue font-bold text-xl">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
              </div>
              <div class="text-sm text-cp-grey">
                {{ Str::limit($item->description, 80) }}
              </div>
            </div>
          </div>
        </a>
      @empty
        <p class="text-center text-cp-light-grey w-full">Belum ada produk tersedia.</p>
      @endforelse
    </div>

  </div>
</div>

@endsection
