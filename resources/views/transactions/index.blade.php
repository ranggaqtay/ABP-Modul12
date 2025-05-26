@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="h3 text-danger fw-bold mb-4"> Daftar Transaksi</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('transactions.create') }}" class="btn btn-danger">
            + Tambah Transaksi Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-danger text-center">
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->customer->name }}</td>
                        <td>{{ $transaction->product->name }}</td>
                        <td class="text-center">{{ intval($transaction->total_price / $transaction->product->price) }}</td>
                        <td class="text-end">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-warning">
                                     Edit
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                         Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted fst-italic">
                            Belum ada transaksi yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>
</div>
@endsection