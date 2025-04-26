@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-20">
    <div class="p-4">
        <div class="flex flex-col rounded-2xl p-5 h-[92vh] relative bg-white">
            <h1 class="text-2xl font-bold mb-2" style="color: #070A52;">Product Data</h1>
            <a href="{{ route('products.create') }}" class="rounded-md bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4 w-40">
                Add Data
            </a>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-x-auto sm:rounded-lg w-full">
                <table class="w-full table-auto text-sm text-left rtl:text-right text-gray-500 overflow-hidden">
                    <thead class="text-xs uppercase border-b border-gray-700" style="color: #070A52;">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-extrabold">No</th>
                            <th scope="col" class="px-6 py-3 font-extrabold">Product Name</th>
                            <th scope="col" class="px-6 py-3 font-extrabold">Price</th>
                            <th scope="col" class="px-6 py-3 font-extrabold">Date</th>
                            <th scope="col" class="px-6 py-3 font-extrabold">Product Photo</th>
                            <th scope="col" class="px-6 py-3 font-extrabold">Stock</th>
                            <th scope="col" class="px-6 py-3 font-extrabold">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                        <tr class="{{ $loop->odd ? 'bg-gray-100' : '' }}">
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">{{ $product->product_name }}</td>
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">Rp.{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">{{ \Carbon\Carbon::parse($product->datetime)->format('j F Y, H:i:s') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                @if ($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto Produk" class="w-24 h-24 object-cover rounded-md">
                                @else
                                    No photo available
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">{{ $product->stock_products }}</td>
                            <td class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-400 hover:bg-red-500 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection