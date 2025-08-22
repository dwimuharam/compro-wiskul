<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ShopItem; // pakai ShopItem sesuai struktur DB-mu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function index()
    {
        // --- summary ---
        $totalSales     = (float) Transaction::sum('total_price');
        $totalOrders    = (int) Transaction::count();
        $totalRevenue   = $totalSales;
        $totalCustomers = (int) Transaction::distinct('user_id')->count('user_id');

        // --- revenue per month ---
        $revenueByMonth = Transaction::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // convert angka bulan (1..12) -> nama bulan, dan totals jadi array float
        $months = $revenueByMonth->map(function ($r) {
            return \DateTime::createFromFormat('!m', $r->month)->format('F'); // January, ...
        })->values()->toArray();

        $totals = $revenueByMonth->pluck('total')
            ->map(fn($v) => (float) $v)
            ->values()->toArray();

        // --- top selling products ---
        // Perhatikan: join berdasarkan kolom shop_item_id pada transaction_items
        $topProducts = ShopItem::select(
                'shop_items.id',
                'shop_items.name',
                'shop_items.price',
                'shop_items.category',
                DB::raw('SUM(transaction_items.quantity) as quantity_sold'),
                DB::raw('SUM(transaction_items.quantity * transaction_items.price) as total_amount')
            )
            ->join('transaction_items', 'shop_items.id', '=', 'transaction_items.shop_item_id')
            ->groupBy('shop_items.id', 'shop_items.name', 'shop_items.price', 'shop_items.category')
            ->orderByDesc('quantity_sold')
            ->take(5)
            ->get();

        return view('dashboard.sales-report', [
            'totalSales'     => $totalSales,
            'totalOrders'    => $totalOrders,
            'totalRevenue'   => $totalRevenue,
            'totalCustomers' => $totalCustomers,
            'months'         => $months,
            'totals'         => $totals,
            'topProducts'    => $topProducts,
        ]);
    }
}
