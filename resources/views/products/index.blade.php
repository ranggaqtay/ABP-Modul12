@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Judul -->
    <h1 class="text-4xl font-bold text-black-700 mb-4"> Daftar Produk</h1>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-6 shadow-md text-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Produk Baru -->
    <div class="text-right mb-6">
        <a href="{{ route('products.create') }}"
           class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200">
            + Tambah Produk Baru
        </a>
    </div>

    <!-- Tabel Produk -->
    <div class="overflow-x-auto bg-yellow-50 border border-yellow-200 shadow-2xl rounded-xl mb-6">
        <table class="min-w-full divide-y divide-yellow-200">
            <thead class="bg-yellow-200">
                <tr>
                    <th class="px-6 py-4 text-left text-base font-bold text-black-800">Nama Produk</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-black-800">Deskripsi</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-black-800">Harga</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-black-800">Kategori</th>
                    <th class="px-6 py-4 text-center text-base font-bold text-black-800">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-100">
                @forelse($products as $product)
                <tr class="hover:bg-yellow-100 transition duration-150">
                    <td class="px-6 py-4 text-base text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-base text-gray-800">{{ $product->description }}</td>
                    <td class="px-6 py-4 text-base text-yellow-700 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-base text-gray-900">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 text-base text-center space-x-3">
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-4 py-2 rounded-lg shadow-md transition duration-200">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-4 py-2 rounded-lg shadow-md transition duration-200">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-base text-gray-500 italic">
                        Belum ada produk yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection