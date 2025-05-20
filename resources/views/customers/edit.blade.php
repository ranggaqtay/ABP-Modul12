@extends('layouts.app')

@section('content')
<div class="w-full py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Edit Pelanggan</h1>

    <!-- Menampilkan error validasi jika ada -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 max-w-full">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Pelanggan -->
    <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Pelanggan</label>
            <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-semibold mb-2">No Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <div class="mb-6">
            <label for="address" class="block text-gray-700 font-semibold mb-2">Alamat</label>
            <input type="text" id="address" name="address" value="{{ old('address', $customer->address) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <!-- Tombol Update -->
        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-300">
                Update
            </button>
        </div>
    </form>
</div>
@endsection