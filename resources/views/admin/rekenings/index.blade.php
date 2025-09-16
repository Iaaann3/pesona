@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <h1 class="mb-4 text-center">Daftar Rekening</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success w-100" style="max-width:1200px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card w-100 mt-2" style="max-width:1200px;">
        <div class="card-body">

            {{-- Tombol tambah --}}
            <div class="mb-3 text-end">
                <a href="{{ route('admin.rekenings.create') }}" class="btn btn-success">
                    + Tambah Rekening
                </a>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Bank</th>
                            <th>Nomor Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($rekenings as $rekening)
                            <tr>
                                <td>{{ $loop->iteration + ($rekenings->currentPage()-1) * $rekenings->perPage() }}</td>
                                <td>{{ $rekening->bank_name }}</td>
                                <td>{{ $rekening->number }}</td>
                                <td>
                                    <a href="{{ route('admin.rekenings.edit', $rekening->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <form action="{{ route('admin.rekenings.destroy', $rekening->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin hapus rekening ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1">Hapus</button>
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

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $rekenings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
