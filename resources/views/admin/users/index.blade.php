@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <h1 class="mb-4 text-center">Data User</h1>
    <div class="card w-100 mt-2" style="max-width:1200px;">
        <div class="card-body">

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tombol tambah --}}
            <div class="mb-3 text-end">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">+ Tambah User</a>
            </div>

            {{-- Tabel user --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Rumah</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration + ($users->currentPage()-1) * $users->perPage() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->no_rumah }}</td>
                                <td>{{ $user->no_tlp }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data user</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($users->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
