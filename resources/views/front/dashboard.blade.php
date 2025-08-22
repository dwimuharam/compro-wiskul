@extends('front.layouts.app')

@section('content')
<div class="container max-w-[1130px] mx-auto py-10">
    <h1 class="text-3xl font-bold">Halo, {{ auth()->user()->name }}</h1>
    <p class="text-cp-grey mt-2">Selamat datang di halaman akun kamu. Dari sini kamu bisa melihat riwayat transaksi, edit profil, dll.</p>
</div>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="text-red-600 hover:underline">Logout</button>
</form>

@endsection
