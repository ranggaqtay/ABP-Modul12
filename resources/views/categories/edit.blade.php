@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Kategori</h1>

    <!-- Menampilkan error validasi jika ada -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Kategori -->
    <form method="POST" action="{{ route('categories.update', $category->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <input type="text" id="description" name="description" value="{{ old('description', $category->description) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-300">
                Update
            </button>
        </div>
    </form>
</div>
@endsection