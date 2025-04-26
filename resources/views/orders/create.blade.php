@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-20">
    <div class="p-4">
        <div class="flex flex-col rounded-2xl p-5 h-[92vh] relative bg-white">
            <h1 class="text-2xl font-bold mb-2" style="color: #070A52;">Add Order</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <!-- Product Dropdown with Price as Data Attribute -->
                    <div class="mb-4">
                        <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
                        <select name="product_id" id="product_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded-lg py-2 px-4" onchange="updateTotalPrice()">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->product_name }} (Rp.{{ number_format($product->price, 0, ',', '.') }}, Stock: {{ $product->stock_products }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input Quantity -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded-lg py-2 px-4" oninput="updateTotalPrice()">
                    </div>

                    <!-- Total Price, Auto-filled -->
                    <div class="mb-4">
                        <label for="total_price" class="block text-gray-700 text-sm font-bold mb-2">Total Price:</label>
                        <input type="number" name="total_price" id="total_price" class="block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded-lg py-2 px-4" readonly>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateTotalPrice() {
        // Ambil elemen yang diperlukan
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const totalPriceInput = document.getElementById('total_price');

        // Ambil harga produk dari data attribute
        const selectedProduct = productSelect.options[productSelect.selectedIndex];
        const pricePerItem = parseFloat(selectedProduct.getAttribute('data-price')) || 0;

        // Ambil quantity yang dimasukkan
        const quantity = parseInt(quantityInput.value) || 0;

        // Hitung total harga
        const totalPrice = pricePerItem * quantity;

        // Set total harga di input field
        totalPriceInput.value = totalPrice;
    }
</script>

@endsection