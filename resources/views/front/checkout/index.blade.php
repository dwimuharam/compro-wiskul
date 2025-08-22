@extends('front.layouts.app')
@section('content')

{{-- Header Section --}}
<div id="header" class="bg-[#F6F7FA] relative h-[700px] -mb-[488px]">
  <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
    <x-navbar/>
  </div>
</div>

{{-- Checkout Form Section --}}
<div id="Checkout" class="container max-w-[1130px] mx-auto flex flex-wrap xl:flex-nowrap justify-between gap-[50px] relative z-10">
  <div class="flex flex-col mt-20 gap-[30px]">
    <div class="breadcrumb flex items-center gap-[30px]">
      <p class="text-cp-light-grey">Home</p>
      <span class="text-cp-light-grey">/</span>
      <p class="text-cp-black font-semibold">Checkout</p>
    </div>
    <h1 class="font-extrabold text-4xl leading-[45px]">Lengkapi Checkout Kamu</h1>
    <p class="text-cp-light-grey max-w-[450px]">Masukkan informasi lengkap untuk melanjutkan ke pembayaran.</p>
  </div>

  <form action="{{ route('checkout.store') }}" method="POST" class="flex flex-col p-[30px] rounded-[20px] gap-[18px] bg-white shadow-[0_10px_30px_0_#D1D4DF40] w-full md:w-[700px] shrink-0">
    @csrf

    {{-- Full Name --}}
    <div class="flex flex-col gap-2">
      <p class="font-semibold">Nama Lengkap</p>
      <input type="text" name="full_name" required value="{{ old('full_name') }}" placeholder="Tulis nama lengkap kamu" class="p-[14px_20px] border border-[#E8EAF2] rounded-xl placeholder:font-normal placeholder:text-cp-black font-semibold">
    </div>

    {{-- Phone Number --}}
    <div class="flex flex-col gap-2">
      <p class="font-semibold">Nomor Telepon</p>
      <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="Contoh: +62 812 3456 7890" class="p-[14px_20px] border border-[#E8EAF2] rounded-xl placeholder:font-normal placeholder:text-cp-black font-semibold">
    </div>

    {{-- Address --}}
    <div class="flex flex-col gap-2">
      <p class="font-semibold">Alamat Pengiriman</p>
      <textarea name="address" rows="4" required placeholder="Masukkan alamat lengkap pengiriman" class="p-[14px_20px] border border-[#E8EAF2] rounded-xl placeholder:font-normal placeholder:text-cp-black font-semibold">{{ old('address') }}</textarea>
    </div>

    {{-- Note --}}
    <div class="flex flex-col gap-2">
      <p class="font-semibold">Catatan (opsional)</p>
      <textarea name="note" rows="3" placeholder="Catatan tambahan jika ada" class="p-[14px_20px] border border-[#E8EAF2] rounded-xl placeholder:font-normal placeholder:text-cp-black font-semibold">{{ old('note') }}</textarea>
    </div>

    {{-- Payment Method --}}
    <div class="flex flex-col gap-2">
      <p class="font-semibold">Metode Pembayaran</p>
      <select name="payment_method" required class="p-[14px_20px] border border-[#E8EAF2] rounded-xl font-semibold text-cp-black">
        <option value="" hidden>Pilih metode</option>
        <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
        <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
      </select>
    </div>

    {{-- Payment Channel --}}
    <div class="flex flex-col gap-2">
      <p class="font-semibold">Channel Pembayaran</p>
      <select name="payment_channel" required class="p-[14px_20px] border border-[#E8EAF2] rounded-xl font-semibold text-cp-black">
        <option value="" hidden>Pilih channel</option>
        <optgroup label="Bank Transfer">
          <option value="BCA">BCA</option>
          <option value="Mandiri">Mandiri</option>
          <option value="BNI">BNI</option>
        </optgroup>
        <optgroup label="E-Wallet">
          <option value="Dana">Dana</option>
          <option value="Gopay">Gopay</option>
          <option value="OVO">OVO</option>
          <option value="ShopeePay">ShopeePay</option>
        </optgroup>
      </select>
    </div>

    {{-- Submit Button --}}
    <button type="submit" class="bg-cp-dark-blue p-5 w-full rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">
      Proses Checkout
    </button>
  </form>
</div>

@endsection
