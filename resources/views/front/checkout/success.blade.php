@extends('front.layouts.app')
@section('content')

{{-- Header Section --}}
{{-- <div id="header" class="relative h-[700px] -mb-[488px]">
  <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
    <x-navbar/>
  </div>
</div> --}}

<div class="py-20 min-h-[90vh] flex items-center justify-center">
  <div class="container max-w-[700px] mx-auto bg-white p-10 rounded-2xl shadow-[0_10px_30px_0_#D1D4DF40] text-center flex flex-col items-center gap-6">

    {{-- Icon Berhasil --}}
    <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
    </div>

    {{-- Judul & Pesan --}}
    <div class="flex flex-col gap-2">
      <h2 class="text-3xl font-extrabold text-cp-dark-blue">Pembayaran Berhasil!</h2>
      <p class="text-cp-black text-base">Terima kasih telah melakukan pemesanan. Bukti pembayaranmu telah kami terima dan sedang kami proses.</p>
    </div>

    {{-- Tombol Aksi --}}
    <a href="{{ route('front.shop') }}"
       class="bg-cp-dark-blue p-5 w-full rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">
      Kembali Belanja
    </a>

  </div>
</div>

@endsection
