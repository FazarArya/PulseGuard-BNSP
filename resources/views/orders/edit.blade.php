@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-20">
    <div class="p-4">
        <div class="flex flex-col rounded-2xl p-5 h-[92vh] relative bg-white">
            <h1 class="text-2xl font-bold mb-2" style="color: #070A52;">Edit Order</h1>

            <!-- Display success message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form to edit order -->
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                    <select name="product_id" id="product_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded-lg py-2 px-4">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded-lg py-2 px-4" value="{{ $order->quantity }}">
                </div>

                <!-- Total Price (automatic) -->
                <div class="mb-4">
                    <label for="total_price" class="block text-gray-700 text-sm font-bold mb-2">Total Price:</label>
                    <input type="number" name="total_price" id="total_price" class="block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded-lg py-2 px-4" value="{{ $order->total_price }}" readonly>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection