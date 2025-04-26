@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-20">
    <div class="p-4">
        <div class="flex flex-col rounded-2xl p-5 max-md:h-screen h-[92vh] bg-white">
            <h1 class="text-2xl font-bold mb-4" style="color: #070A52;">Add New Product</h1>

            <!-- Display Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="product_name" class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg p-3" value="{{ old('product_name') }}" required>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" name="price" id="price" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg p-3" value="{{ old('price') }}" required>
                    </div>
                    <div>
                        <label for="stock_products" class="block text-sm font-medium text-gray-700 mb-2">Product Stock</label>
                        <input type="number" name="stock_products" id="stock_products" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg p-3" value="{{ old('stock_products') }}" required>
                    </div>
                    <div>
                        <label for="datetime" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="datetime-local" name="datetime" id="datetime" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg p-3" value="{{ old('datetime') }}" required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Product Photo</label>
                        <input type="file" name="photo" id="photo" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg p-3">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">Save</button>
                    <a href="{{ route('products.index') }}" class="rounded-md bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection