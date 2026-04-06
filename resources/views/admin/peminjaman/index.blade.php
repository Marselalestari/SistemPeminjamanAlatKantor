@extends('layouts.app_admin')
@section('content')
<div class="container">
    <h1>Data Peminjaman</h1>
    <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Nama Peminjam</th>
                <th>Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
            <tr>
                <td>{{ $peminjaman->id }}</td>
                <td>{{ $peminjaman->user_id }}</td>
                <td>{{ $peminjaman->user->name ?? '-' }}</td>
                <td>{{ $peminjaman->alat->nama_alat ?? '-' }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_kembali }}</td>
                <td>{{ $peminjaman->status }}</td>
                <td>
                    <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
