<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Patient;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product', 'patient')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil produk berdasarkan ID
        $product = Product::find($request->product_id);

        // Cek apakah stok mencukupi
        if ($product->stock_products < $request->quantity) {
            return redirect()->back()->withErrors(['Stok produk tidak mencukupi untuk pemesanan ini!']);
        }

        // Ambil pasien yang sedang login
        $patient = auth()->user(); // Mengasumsikan pasien sedang login

        // Hitung total harga
        $totalPrice = $product->price * $request->quantity;

        // Simpan order ke database
        $order = new Order();
        $order->datetime = now();
        $order->patient_id = $patient->id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->total_price = $totalPrice;
        $order->save();

        // Kurangi stok produk setelah order berhasil
        $product->stock_products -= $request->quantity;
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat, stok produk telah dikurangi.');
    }

    public function edit($id)
{
    // Ambil pesanan berdasarkan id
    $order = Order::findOrFail($id);

    // Ambil semua produk untuk dropdown
    $products = Product::all();

    // Tampilkan form edit pesanan
    return view('orders.edit', compact('order', 'products'));
}

public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Ambil pesanan berdasarkan id
    $order = Order::findOrFail($id);

    // Hitung total harga berdasarkan jumlah dan harga produk
    $product = Product::find($request->product_id);
    $total_price = $request->quantity * $product->price;

    // Update pesanan
    $order->update([
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'total_price' => $total_price,
    ]);

    // Redirect ke halaman pesanan dengan pesan sukses
    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
}


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}