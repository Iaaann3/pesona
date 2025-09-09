@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <!-- Header + tombol tambah -->
    <div class="d-flex justify-content-between align-items-center w-100 mb-4" style="max-width:1200px;">
        <h1 class="mb-0">Daftar Rekening</h1>
        <a href="{{ route('admin.rekenings.create') }}" class="btn btn-primary">
            + Tambah Rekening
        </a>
    </div>

    <!-- Notifikasi sukses -->
    @if(session('success'))
        <div class="alert alert-success w-100" style="max-width:1200px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card table -->
    <div class="card w-100 mt-2" style="max-width:1200px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-success text-white text-center">
                        <tr>
                            <th>#</th>
                            <th>Bank</th>
                            <th>Nomor Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($rekenings as $rekening)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rekening->bank_name }}</td>
                                <td>{{ $rekening->number }}</td>
                                <td>
                                    <a href="{{ route('admin.rekenings.edit', $rekening->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                    <form action="{{ route('admin.rekenings.destroy', $rekening->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus rekening ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada rekening.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
