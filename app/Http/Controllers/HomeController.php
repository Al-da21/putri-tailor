<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);

        return view('customer.home.index', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $products = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(8);

        return view('customer.home.index', compact('products'));
    }

        public function customForm($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('customer.product.custom', compact('product'));
    }

    public function handleCustomOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|uuid|exists:products,id',
            'material' => 'required|string|max:255',
            'reference_image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('reference_image')->store('custom-references', 'public');

        // Simpan ke Cart
        Cart::create([
            'users_id' => auth()->id(),
            'products_id' => $request->product_id,
            'qty' => 1,
            'custom_material' => $request->material,
            'custom_image' => $imagePath,
        ]);

        return redirect('/cart')->with('success', 'Produk custom telah ditambahkan ke keranjang.');
    }
}
