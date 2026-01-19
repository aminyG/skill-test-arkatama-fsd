@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Pemilik</h3>

    <form action="{{ route('owners.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="phone_verified" class="form-check-input">
            <label class="form-check-label">Nomor Terverifikasi</label>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
