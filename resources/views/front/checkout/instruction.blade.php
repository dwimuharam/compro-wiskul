@extends('front.layouts.app')
@section('content')

{{-- Header Section --}}
<div id="header" class="bg-[#F6F7FA] relative h-[700px] -mb-[488px]">
  <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
    <x-navbar/>
  </div>
</div>

{{-- Instruction Section --}}
<div id="Instruction" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] relative z-10 mt-20">

  {{-- Breadcrumb --}}
  <div class="breadcrumb flex items-center gap-[30px]">
    <p class="text-cp-light-grey">Home</p>
    <span class="text-cp-light-grey">/</span>
    <p class="text-cp-black font-semibold">Instruksi Pembayaran</p>
  </div>

  {{-- Title --}}
  <h1 class="font-extrabold text-4xl leading-[45px]">Instruksi Pembayaran</h1>

  {{-- Payment Info --}}
  <div class="bg-white p-[30px] rounded-[20px] shadow-[0_10px_30px_0_#D1D4DF40] flex flex-col gap-4 text-cp-black w-full max-w-[800px]">
    <div class="flex justify-between">
      <p class="font-semibold">Nama</p>
      <p>{{ $data['full_name'] }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-semibold">No HP</p>
      <p>{{ $data['phone'] }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-semibold">Alamat</p>
      <p class="text-right max-w-[60%]">{{ $data['address'] }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-semibold">Metode Pembayaran</p>
      <p>{{ $data['payment_method'] }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-semibold">Channel Pembayaran</p>
      <p>{{ $data['payment_channel'] }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-semibold">Nomor VA / Tujuan</p>
      <p class="font-bold text-lg">{{ $data['va_number'] }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-semibold">Total Bayar</p>
      <p class="font-bold text-cp-dark-blue text-lg">Rp {{ number_format(collect($data['cart'])->sum(fn($item) => $item['price'] * $item['quantity'])) }}</p>
    </div>
  </div>

  {{-- Upload Bukti Pembayaran --}}
  <form action="{{ route('checkout.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white p-[30px] rounded-[20px] shadow-[0_10px_30px_0_#D1D4DF40] flex flex-col gap-4 w-full max-w-[800px]">
    @csrf
    <label class="font-semibold">Upload Bukti Pembayaran</label>
    <input type="file" name="payment_proof" required class="border border-[#E8EAF2] rounded-xl p-3 bg-white">
    <button type="submit" class="bg-cp-dark-blue p-5 w-full rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">
      Kirim Bukti Pembayaran
    </button>
  </form>
</div>

@endsection
