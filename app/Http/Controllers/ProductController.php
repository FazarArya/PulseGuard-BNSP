<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Menampilkan form untuk menambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'datetime' => 'required|date',
            'photo' => 'nullable|image|max:2048',
            'stock_products' => 'required|integer'
        ]);

        // Upload photo jika ada
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('products', 'public');
        }

        // Membuat produk baru
        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'datetime' => $request->datetime,
            'photo' => $photoPath,
            'stock_products' => $request->stock_products,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Mengupdate produk yang sudah ada
    public function update(Request $request, $id)
    {
        // Cari produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Validasi input
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_products' => 'required|integer',
            'datetime' => 'required|date',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Update data produk
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock_products = $request->input('stock_products');
        $product->datetime = $request->input('datetime');

        // Update foto jika ada
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('photos', 'public');
            $product->photo = $filePath;
        }

        // Simpan perubahan
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    
    // Menghapus produk
    public function destroy($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    } 
}