<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('front.shop')->with('error', 'Keranjang kamu kosong.');
        }

        return view('front.checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('front.shop')->with('error', 'Keranjang kamu kosong.');
        }

        $request->validate([
            'full_name'        => 'required|string|max:255',
            'address'          => 'required|string',
            'phone'            => 'required|string',
            'note'             => 'nullable|string',
            'payment_method'   => 'required|in:Bank Transfer,E-Wallet',
            'payment_channel'  => 'required|string',
        ]);

        // Kode VA simulasi
        $va_codes = [
            'Bank Transfer' => [
                'BCA'     => '1234567890',
                'Mandiri' => '9876543210',
                'BNI'     => '555566667777',
                'BRI'     => '333322221111',
            ],
            'E-Wallet' => [
                'GoPay'      => '0812-3456-7890',
                'DANA'       => '0896-1234-5678',
                'ShopeePay'  => '0878-8888-9999',
                'OVO'        => '0812-0000-1111',
            ],
        ];

        $selected_channel = $request->payment_channel;
        $va_number = $va_codes[$request->payment_method][$selected_channel] ?? 'VA-TIDAK-DITEMUKAN';

        // Simpan data checkout ke session
        session([
            'checkout_data' => [
                'full_name'        => $request->full_name,
                'address'          => $request->address,
                'phone'            => $request->phone,
                'note'             => $request->note,
                'payment_method'   => $request->payment_method,
                'payment_channel'  => $selected_channel,
                'va_number'        => $va_number,
                'cart'             => $cart,
            ]
        ]);

        return view('front.checkout.instruction', [
            'data' => session('checkout_data')
        ]);
    }

    public function paymentUpload(Request $request)
    {
        $data = session('checkout_data');

        if (!$data || empty($data['cart'])) {
            return redirect()->route('front.shop')->with('error', 'Data checkout tidak ditemukan.');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Simpan transaksi ke database
        $transaction = DB::transaction(function () use ($data, $path) {
            $transaction = auth()->user()->transactions()->create([
                'full_name'        => $data['full_name'],
                'address'          => $data['address'],
                'phone'            => $data['phone'],
                'note'             => $data['note'],
                'payment_method'   => $data['payment_method'],
                'payment_channel'  => $data['payment_channel'],
                'va_number'        => $data['va_number'],
                'total_price'      => collect($data['cart'])->sum(fn($item) => $item['price'] * $item['quantity']),
                'payment_proof'    => $path,
                'status'           => 'paid',
            ]);

            foreach ($data['cart'] as $id => $item) {
                $transaction->items()->create([
                    'shop_item_id' => $id,
                    'quantity'     => $item['quantity'],
                    'price'        => $item['price'],
                ]);
            }

            return $transaction;
        });

        // Hapus session cart & checkout
        session()->forget(['cart', 'checkout_data']);

        return redirect()->route('payment.success')->with('success', 'Pembayaran berhasil!');
    }
}
