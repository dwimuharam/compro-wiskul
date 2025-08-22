@extends('front.layouts.app')
@section('content')

<div class="container max-w-[1130px] mx-auto py-20">
  <h2 class="text-3xl font-bold mb-6">Upload Bukti Pembayaran</h2>

  <form action="{{ route('payment.upload', $transaction->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 max-w-lg">
    @csrf

    <div class="flex flex-col gap-2">
      <label class="font-semibold">Upload Bukti Transfer</label>
      <input type="file" name="payment_proof" accept="image/*" required class="border border-[#E8EAF2] rounded-xl p-3">
    </div>

    <button type="submit" class="bg-cp-dark-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-cp-light-blue transition">
      Kirim Bukti Pembayaran
    </button>
  </form>
</div>

@endsection
