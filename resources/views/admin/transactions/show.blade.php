<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Transaction') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                {{-- Buyer Info --}}
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        @php
                            $firstItem = $transaction->items->first();
                        @endphp
                        @if ($firstItem)
                            <img src="{{ Storage::url($firstItem->shopItem->thumbnail ?? '') }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        @else
                            <div class="w-[120px] h-[90px] bg-gray-200 rounded-2xl flex items-center justify-center text-sm text-gray-500">No Image</div>
                        @endif
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Buyer</p>
                            <p class="text-slate-500 text-sm font-bold">{{ $transaction->user->name ?? '-' }}</p>
                            <h3 class="text-indigo-950 text-xl font-bold">Nama Pengiriman: {{ $transaction->full_name }}</h3>
                        </div>
                    </div>  
                </div>

                <hr class="my-5">

                {{-- Produk dalam transaksi --}}
                <div class="flex flex-col gap-4">
                    <h3 class="font-bold text-lg">Products</h3>
                    @foreach ($transaction->items as $item)
                        <div class="flex justify-between items-center border p-4 rounded-lg">
                            <div class="flex items-center gap-x-4">
                                <img src="{{ Storage::url($item->shopItem->thumbnail ?? '') }}" class="w-[60px] h-[60px] object-cover rounded-lg" alt="thumbnail">
                                <div class="flex flex-col">
                                    <p class="font-bold text-indigo-950">{{ $item->shopItem->name }}</p>
                                    <p class="text-sm text-slate-500">{{ ucfirst($item->shopItem->category) }}</p>
                                </div>
                            </div>
                            <p class="font-semibold text-indigo-950">Rp {{ number_format($item->shopItem->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <hr class="my-5">

                {{-- Ringkasan transaksi --}}
                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Total Price</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </h3>
                        </div>

                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Status</p>
                            <h3 class="text-indigo-950 text-xl font-bold capitalize">
                                {{ $transaction->status }}
                            </h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Transaction Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{ $transaction->created_at->format('M d, Y') }}
                            </h3>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <a href="#" class="text-center font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                    Follow Up Customer
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
