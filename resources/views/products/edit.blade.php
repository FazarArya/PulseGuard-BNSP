@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-20">
    <div class="p-4">
        <div class="flex flex-col rounded-2xl p-5 max-md:h-screen h-[92vh] relative" style="background-color: white;">
            <h1 class="text-2xl font-bold mb-4" style="color: #070A52;">Edit Product</h1>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="flex flex-col">
                <label for="product_name" class="text-gray-700 font-semibold">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="rounded-md border border-gray-300 p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" value="{{ old('product_name', $product->product_name) }}" required>
            </div>
            <div class="flex flex-col">
                <label for="price" class="text-gray-700 font-semibold">Product Price (Rp)</label>
                <input type="number" id="price" name="price" class="rounded-md border border-gray-300 p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="flex flex-col">
                <label for="stock_products" class="text-gray-700 font-semibold">Product Stock</label>
                <input type="number" id="stock_products" name="stock_products" class="rounded-md border border-gray-300 p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" value="{{ old('stock_products', $product->stock_products) }}" required>
            </div>
            <div class="flex flex-col">
                <label for="datetime" class="text-gray-700 font-semibold">Date</label>
                <input type="datetime-local" id="datetime" name="datetime" class="rounded-md border border-gray-300 p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" value="{{ old('datetime', \Carbon\Carbon::parse($product->datetime)->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="flex flex-col">
                <label for="photo" class="text-gray-700 font-semibold">Product Photo</label>
                <input type="file" id="photo" name="photo" class="rounded-md border border-gray-300 p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                @if ($product->photo)
                <div class="mt-3">
                    <p class="text-gray-500 text-sm">Current Photo:</p>
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Product Photo" class="w-32 h-32 object-cover mt-2 rounded-lg">
                </div>
                @endif
            </div>
            <div class="flex space-x-3 mt-6">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Save Changes
                </button>
                <a href="{{ route('products.index') }}" class="rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                Cancel
                </a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection