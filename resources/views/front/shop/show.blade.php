@extends('front.layouts.app')
@section('content')

<div id="header" class="relative h-[600px] -mb-[388px]">
    <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
        <x-navbar/>
    </div>
  </div>
  {{-- Product Detail Section --}}
<div class="w-full px-[10px] relative z-10 mt-[250px] mb-20">
  <div class="container max-w-[1130px] mx-auto flex flex-col gap-10">
    
    {{-- Breadcrumb --}}
    <div class="breadcrumb flex items-center gap-[10px] text-sm text-cp-light-grey">
      <a href="{{ route('front.index') }}" class="hover:text-cp-black">Home</a>
      <span>/</span>
      <a href="{{ route('front.shop') }}" class="hover:text-cp-black">Products</a>
      <span>/</span>
      <span class="text-cp-black font-semibold">{{ $item->name }}</span>
    </div>

    {{-- Content --}}
    <div class="flex flex-col lg:flex-row gap-10 items-start">
      {{-- Image --}}
      <div class="w-full lg:w-1/2 rounded-2xl overflow-hidden shadow-md border border-[#E8EAF2]">
        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->name }}" class="w-full h-[400px] object-cover object-center">
      </div>

      {{-- Info --}}
      <div class="w-full lg:w-1/2 flex flex-col gap-6">
        <div class="flex flex-col gap-2">
          <p class="uppercase text-sm text-cp-light-grey">New Collection</p>
          <h1 class="text-3xl font-extrabold text-cp-black">{{ $item->name }}</h1>
          <p class="capitalize text-cp-grey">{{ $item->category }}</p>
        </div>

        <div class="flex items-center gap-2">
          @for ($i = 0; $i < 5; $i++)
            <img src="{{ asset('assets/icons/star.svg') }}" class="w-5 h-5" alt="star">
          @endfor
        </div>

        <p class="text-2xl font-bold text-cp-dark-blue">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
        <p class="text-cp-grey text-base leading-relaxed">
          <p>Description</p><hr>
          {{ $item->description }}
        </p>

        <div class="flex flex-col sm:flex-row items-center gap-4 mt-4">

  {{-- Quantity selector --}}
  @auth
  <form action="{{ route('cart.add', $item->id) }}" method="POST" class="flex items-center gap-4">
    @csrf
    <div class="flex items-center gap-2 border border-[#E8EAF2] rounded-full px-4 py-2">
      <button type="button" onclick="decreaseQty()" class="text-cp-dark-blue font-bold text-lg px-2">-</button>
      <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-12 text-center border-none outline-none bg-transparent font-semibold text-cp-black">
      <button type="button" onclick="increaseQty()" class="text-cp-dark-blue font-bold text-lg px-2">+</button>
    </div>
    
    

    {{-- Add to Cart --}}
    <button type="submit" class="border border-[#E8EAF2] p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-regular text-cp-dark-blue">
      Add to Cart
    </button>
  </form>

  {{-- Buy Now --}}
  <a href="{{ route('checkout.index') }}" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Buy Now</a>
@else
  <div class="flex items-center gap-4">
    <a href="{{ route('login') }}" class="border border-[#E8EAF2] p-[14px_20px] rounded-xl text-cp-dark-blue font-semibold hover:underline">
      Add to Cart
    </a>
    <a href="{{ route('login') }}" class="p-[14px_20px] rounded-xl bg-cp-dark-blue text-white font-bold hover:bg-cp-light-blue">
      Buy Now
    </a>
  </div>
@endauth
</div>

      </div>
    </div>
  </div>
</div>
@endsection

@push('after-scripts')
<script>
  function decreaseQty() {
    const qtyInput = document.getElementById('quantity');
    if (parseInt(qtyInput.value) > 1) {
      qtyInput.value = parseInt(qtyInput.value) - 1;
    }
  }

  function increaseQty() {
    const qtyInput = document.getElementById('quantity');
    qtyInput.value = parseInt(qtyInput.value) + 1;
  }
</script>
@endpush
