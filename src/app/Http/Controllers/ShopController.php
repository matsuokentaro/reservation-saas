<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();

        return view('shops.index', compact('shops'));

    }

    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request)
    {
        Shop::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
        ]);

        return redirect()->route('shops.index');
    }

    public function edit(Shop $shop)
    {
        return view('shops.edit', compact('shop'));
    }

    public function update(Request $request, Shop $shop)
    {
        $shop->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
        ]);

        return redirect()->route('shops.index');
    }
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()->route('shops.index');
    }

}