<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales Report') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-8">

                {{-- STAT CARDS --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-indigo-50 p-6 rounded-2xl shadow flex flex-col">
                        <p class="text-slate-500 text-sm">Total Sales</p>
                        <h3 class="text-indigo-950 text-2xl font-bold">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-2xl shadow flex flex-col">
                        <p class="text-slate-500 text-sm">Total Orders</p>
                        <h3 class="text-indigo-950 text-2xl font-bold">{{ $totalOrders }}</h3>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-2xl shadow flex flex-col">
                        <p class="text-slate-500 text-sm">Total Revenue</p>
                        <h3 class="text-indigo-950 text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-2xl shadow flex flex-col">
                        <p class="text-slate-500 text-sm">Total Customers</p>
                        <h3 class="text-indigo-950 text-2xl font-bold">{{ $totalCustomers }}</h3>
                    </div>
                </div>

                {{-- REVENUE CHART --}}
                <div class="bg-white p-6 rounded-2xl shadow border">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>

                {{-- TOP SELLING PRODUCTS --}}
                <div class="bg-white p-6 rounded-2xl shadow border">
                    <h3 class="text-lg font-semibold mb-4 text-indigo-950">Top Selling Products</h3>
                    <table class="w-full border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 border text-left">Product Name</th>
                                <th class="p-3 border text-left">Price</th>
                                <th class="p-3 border text-left">Category</th>
                                <th class="p-3 border text-left">Quantity Sold</th>
                                <th class="p-3 border text-left">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $product)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-3">{{ $product->name }}</td>
                                    <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="p-3">{{ $product->category }}</td>
                                    <td class="p-3">{{ $product->quantity_sold }}</td>
                                    <td class="p-3">Rp {{ number_format($product->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($months);
        const dataPoints = @json($totals);

        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: dataPoints,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.15)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</x-app-layout>
