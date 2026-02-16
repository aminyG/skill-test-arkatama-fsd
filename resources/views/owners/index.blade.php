@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Pemilik</h3>
    <a href="{{ route('owners.create') }}" class="btn btn-primary mb-3">Tambah Pemilik</a>

    <table class="table table-hover shadow-sm bg-white rounded">
        <tr>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Terverifikasi</th>
            <th>Aksi</th>
        </tr>
        @foreach($owners as $o)
        <tr>
            <td>{{ $o->name }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ $o->phone_verified ? 'Ya' : 'Belum' }}</td>
            <td>
                <a href="{{ route('owners.edit', $o->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('owners.destroy', $o->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
        </tr>
        @endforeach
    </table>
</div>
@endsection
