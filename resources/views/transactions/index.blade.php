@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Judul -->
    <h1 class="text-4xl font-bold text-yellow-700 mb-4">Daftar Transaksi</h1>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="bg-balck-100 border border-black-400 text-black-700 px-4 py-3 rounded-lg mb-6 shadow-md text-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Transaksi Baru -->
    <div class="text-right mb-6">
        <a href="{{ route('transactions.create') }}"
           class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200">
            + Tambah Transaksi Baru
        </a>
    </div>

    <!-- Tabel Transaksi -->
    <div class="overflow-x-auto bg-yellow-50 border border-yellow-200 shadow-2xl rounded-xl mb-6">
        <table class="min-w-full divide-y divide-yellow-200">
            <thead class="bg-yellow-200">
                <tr>
                    <th class="px-6 py-4 text-left text-base font-bold text-black-800">Pelanggan</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-black-800">Produk</th>
                    <th class="px-6 py-4 text-right text-base font-bold text-black-800">Total Harga</th>
                    <th class="px-6 py-4 text-center text-base font-bold text-black-800">Tanggal Transaksi</th>
                    <th class="px-6 py-4 text-center text-base font-bold text-black-800">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-100">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-yellow-100 transition duration-150">
                    <td class="px-6 py-4 text-base text-gray-900">{{ $transaction->customer->name }}</td>
                    <td class="px-6 py-4 text-base text-gray-800">{{ $transaction->product->name }}</td>
                    <td class="px-6 py-4 text-base text-yellow-700 font-semibold text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-base text-gray-900 text-center">{{ $transaction->transaction_date }}</td>
                    <td class="px-6 py-4 text-base text-center space-x-3">
                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                           class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-4 py-2 rounded-lg shadow-md transition duration-200">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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
                        Belum ada transaksi yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
</div>
@endsection