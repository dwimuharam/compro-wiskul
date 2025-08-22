<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Transactions') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse($transactions as $transaction)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        {{-- Gambar thumbnail produk pertama --}}
                        @php
                            $firstItem = $transaction->items->first();
                        @endphp
                        @if ($firstItem)
                            <img src="{{ Storage::url($firstItem->shopItem->thumbnail ?? '') }}" alt="thumbnail" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        @else
                            <div class="w-[90px] h-[90px] bg-gray-200 rounded-2xl flex items-center justify-center text-sm text-gray-500">No Image</div>
                        @endif

                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{ $transaction->user->name ?? 'Guest' }}
                            </h3>
                            <p class="text-slate-500 text-sm">
                                {{ count($transaction->items) }} produk
                            </p>
                        </div>
                    </div> 

                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Total</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Tanggal</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{ $transaction->created_at->format('M d, Y') }}
                        </h3>
                    </div>

                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Status</p>
                        <h3 class="text-indigo-950 text-xl font-bold capitalize">
                            {{ $transaction->status }}
                        </h3>
                    </div>

                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        {{-- Optional: Tambahkan route detail jika tersedia --}}
                        <a href="{{ route('admin.transactions.show', $transaction) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Details
                        </a>
                    </div>
                </div> 
                @empty
                <p class="text-center text-gray-500">Belum ada transaksi</p>
                @endforelse

                {{-- Tambahkan pagination jika ingin --}}
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
