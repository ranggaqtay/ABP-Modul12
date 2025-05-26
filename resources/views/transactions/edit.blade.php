@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-danger fw-bold">Edit Transaksi</h1>

    <!-- Menampilkan error validasi jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Transaksi -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="customer_id" class="form-label fw-semibold">Pelanggan</label>
                    <select id="customer_id" name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="product_id" class="form-label fw-semibold">Produk</label>
                    <select id="product_id" name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label fw-semibold">Jumlah Produk</label>
                    <input type="number" id="quantity" name="quantity" min="1" required
                        value="{{ old('quantity', intval($transaction->total_price / $transaction->product->price)) }}"
                        class="form-control @error('quantity') is-invalid @enderror">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="transaction_date" class="form-label fw-semibold">Tanggal Transaksi</label>
                    <input type="date" id="transaction_date" name="transaction_date" required
                        value="{{ old('transaction_date', $transaction->transaction_date) }}"
                        class="form-control @error('transaction_date') is-invalid @enderror">
                    @error('transaction_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-danger px-4 fw-semibold">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection