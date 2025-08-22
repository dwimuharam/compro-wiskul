<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopItemRequest;
use App\Http\Requests\UpdateShopItemRequest;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $shopItems = ShopItem::orderByDesc('id')->paginate(10);
        return view('admin.shop_items.index', compact('shopItems'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.shop_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopItemRequest $request)
    {
        // insert kepada database pada table tertentu
        // closure-based transaction

        DB::transaction(function() use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newShopItem = ShopItem::create($validated);
        });

        return redirect()->route('admin.shop_items.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(ShopItem $shopItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopItem $shopItem)
    {
        //
        return view('admin.shop_items.edit', compact('shopItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopItemRequest $request, ShopItem $shopItem)
    {
        //
        DB::transaction(function() use ($request, $shopItem) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $shopItem->update($validated);
        });

        return redirect()->route('admin.shop_items.index')->with('success', 'Item berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopItem $ShopItem)
    {
        //
        DB::transaction(function() use ($ShopItem) {
            $ShopItem->delete();
        });
        return redirect()->route('admin.shop_items.index')->with('success', 'Item berhasil dihapus!');
    }
}
