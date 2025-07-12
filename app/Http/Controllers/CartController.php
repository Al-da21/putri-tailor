<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // kalau belum login, harus login dulu
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Hapus eager loading 'product.category' karena category sudah tidak ada
        $cart = Cart::with('product')->where('users_id', auth()->id())->get();
        return view('customer.cart.index', compact('cart'));
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::where('users_id', auth()->id())->findOrFail($id);
        $cart->delete();
        return back();
    }

    public function getCartData(Request $request)
    {
        $data = $request->all();
        $data['users_id'] = auth()->id();

        $products_qty = array_combine($data['products_id'], $data['qty']);
        $products = Product::whereIn('id', $data['products_id'])->get();

        $checkout_data = [];

        foreach ($products as $product) {
            $cart = Cart::where('products_id', $product->id)
                        ->where('users_id', auth()->id())
                        ->first();
                        
            if ($cart) {
                $cart->update(['qty' => $products_qty[$product->id]]);

                $itemData = [
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'product_capital_price' => $product->capital_price,
                    'product_image' => $product->image,
                    'qty' => $cart->qty,
                    'sub_total' => $cart->qty * $product->price,
                    'total_weight' => $products_qty[$product->id] * $product->weight,
                    'total_profit' => ($product->price - $product->capital_price) * $products_qty[$product->id],
                ];

                // Tambahkan data custom hanya jika ada
                if ($cart->custom_material || $cart->custom_image || $cart->custom_size) {
                    $itemData['is_custom'] = true;
                    $itemData['custom_material'] = $cart->custom_material;
                    $itemData['custom_image'] = $cart->custom_image;
                    $itemData['custom_size'] = $cart->custom_size;
                } else {
                    $itemData['is_custom'] = false;
                }

                $checkout_data[$product->id] = $itemData;
            }
        }

        $data['checkout_data'] = $checkout_data;
        unset($data['products_id'], $data['qty']);
        $request->session()->put('checkout_data', $data);

        return redirect('/checkout');
    }
}

