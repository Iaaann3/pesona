@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Rekening</h1>
    <form action="{{ route('admin.rekenings.update', $rekening->id) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Bank</label>
            <input type="text" name="bank_name" value="{{ old('bank_name', $rekening->bank_name) }}" class="w-full border px-3 py-2 rounded @error('bank_name') border-red-500 @enderror">
            @error('bank_name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nomor Rekening</label>
            <input type="text" name="number" value="{{ old('number', $rekening->number) }}" class="w-full border px-3 py-2 rounded @error('number') border-red-500 @enderror">
            @error('number')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.rekenings.index') }}" class="text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
