<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = \App\Models\Transaction::with(['user', 'items.shopItem'])
                            ->latest()
                            ->paginate(10); // <-- hanya ambil 10 data per halaman
        return view('admin.transactions.index', compact('transactions'));
    }
    public function show(Transaction $transaction)
    {
        $transaction->load('items.shopItem', 'user');
        return view('admin.transactions.show', compact('transaction'));
    }
}
