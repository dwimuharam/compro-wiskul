<?php

namespace App\Http\Controllers;

use App\Models\ShopItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $item = ShopItem::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price,
                'thumbnail' => $item->thumbnail,
                'quantity' => $request->input('quantity', 1),
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke cart.');
    }

    public function index()
    {
        $cart = session('cart', []);
        return view('front.cart.index', compact('cart'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari cart.');
    }
}
