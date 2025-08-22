@extends('front.layouts.app')
@section('content')

<div id="header" class="relative h-[600px] -mb-[388px]">
  <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
    <x-navbar/>
  </div>
</div>

{{-- Cart Page --}}
<div class="w-full px-[10px] relative z-10 mt-[250px] mb-20">
  <div class="container max-w-[1130px] mx-auto flex flex-col gap-10">
    {{-- Breadcrumb --}}
    <div class="breadcrumb flex items-center gap-[10px] text-sm text-cp-light-grey">
      <a href="{{ route('front.index') }}" class="hover:text-cp-black">Home</a>
      <span>/</span>
      <span class="text-cp-black font-semibold">Shopping Cart</span>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-4 rounded mb-5 text-center">
        {{ session('success') }}
      </div>
    @endif

    {{-- Content --}}
    @if(count($cart) > 0)
      @php $total = 0; @endphp

      <div class="flex flex-col lg:flex-row gap-10">
        {{-- Left: Cart Items --}}
        <div class="w-full lg:w-2/3 flex flex-col gap-6">
          @foreach($cart as $id => $item)
            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
            <div class="flex justify-between items-start">
              <div class="flex items-center gap-4">
                <img src="{{ Storage::url($item['thumbnail']) }}" class="w-20 h-20 object-cover rounded border" alt="">
                <div class="flex flex-col gap-1">
                  <p class="font-bold text-lg text-cp-black">{{ $item['name'] }}</p>
                  <p class="text-cp-grey text-sm">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                  <p class="text-sm text-cp-grey">Qty: {{ $item['quantity'] }}</p>
                  <p class="text-sm text-cp-grey">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
              </div>
              <form action="{{ route('cart.remove', $id) }}" method="POST">
                @csrf
                <button type="submit" class="text-red-500 text-sm hover:underline">Hapus</button>
              </form>
            </div>
          @endforeach
        </div>

        {{-- Right: Summary --}}
        <div class="w-full lg:w-1/3  p-6 rounded-xl">
          <h3 class="text-xl font-bold mb-1">Order Summary</h3>
          <div class="flex justify-between text-cp-grey mb-2">
            <span>Total Items</span>
            <span>{{ count($cart) }}</span>
          </div>
          <div class="flex justify-between text-cp-grey mb-2">
            <span>Subtotal</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between text-cp-grey mb-2">
            <span>Shipping</span>
            <span>Rp 0</span>
          </div>
          <div class="flex justify-between text-cp-grey mb-2">
            <span>Tax</span>
            <span>Rp 0</span>
          </div>
          <hr class="my-4">
          <div class="flex justify-between font-bold text-cp-black text-lg mb-6">
            <span>Total</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div><br>
          <a href="{{ route('checkout.index') }}" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">
            Proceed to Checkout
          </a>
        </div>
      </div>
    @else
      <p class="text-cp-grey text-center">Keranjang kamu masih kosong.</p>
    @endif
  </div>
</div>

@endsection
