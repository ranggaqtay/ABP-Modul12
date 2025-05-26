@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-danger fw-bold">Edit Kategori</h1>

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

    <!-- Form Edit Kategori -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                           class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <input type="text" id="description" name="description" value="{{ old('description', $category->description) }}"
                           class="form-control @error('description') is-invalid @enderror" required>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
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