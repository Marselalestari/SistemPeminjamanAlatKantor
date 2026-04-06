@extends('layouts.app_admin')
@section('content')
<div class="container">
    <h1>Tambah Peminjaman</h1>
    <form action="{{ route('admin.peminjaman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Peminjam</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="alat_id" class="form-label">Alat</label>
            <select name="alat_id" class="form-control" required>
                <option value="">-- Pilih Alat --</option>
                @foreach($alat as $a)
                    <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea name="keperluan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
