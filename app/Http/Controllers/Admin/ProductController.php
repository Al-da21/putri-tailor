<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.form');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['name', 'size', 'price', 'description']);
        $data['slug'] = Str::slug($request->name, '-');

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = Str::slug($request->name) . '-' . now()->timestamp . '.' . $extension;
            $data['image'] = $request->file('image')->storeAs('assets/product', $newName, 'public');
        }

        $data['id'] = (string) Str::uuid();

        Product::create($data);

        return redirect('admin/product')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $item = Product::findOrFail($id);
        return view('admin.product.form', compact('item'));
    }

    public function update(ProductRequest $request, $id)
    {
        $item = Product::findOrFail($id);

        $data = $request->only(['name', 'size', 'price','description']);
        $data['slug'] = Str::slug($request->name, '-');

        if ($request->hasFile('image')) {
            if ($item->image && Storage::exists('public/' . $item->image)) {
                Storage::delete('public/' . $item->image);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = Str::slug($request->name) . '-' . now()->timestamp . '.' . $extension;
            $data['image'] = $request->file('image')->storeAs('assets/product', $newName, 'public');
        }

        $item->update($data);

        return redirect('/admin/product')->with('toast_success', 'Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        
        if ($item->image && Storage::exists('public/' . $item->image)) {
            Storage::delete('public/' . $item->image);
        }
        
        // Untuk hard delete (hapus permanen)
        $item->forceDelete(); // Ganti dari delete() ke forceDelete()
        
        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
