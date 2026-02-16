@extends('layouts.app')

@section('content')
<h3 class="mb-3">Data Pemeriksaan</h3>

<a href="{{ route('checkups.create') }}" class="btn btn-primary mb-3">Tambah Pemeriksaan</a>

<table class="table table-hover shadow-sm bg-white rounded">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Hewan</th>
            <th>Pemilik</th>
            <th>Perawatan</th>
            <th>Catatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checkups as $c)
        <tr>
            <td>{{ $c->checkup_date }}</td>
            <td>{{ $c->pet->name }}</td>
            <td>{{ $c->pet->owner->name }}</td>
            <td>{{ $c->treatment->name }}</td>
            <td>{{ $c->notes }}</td>
            <td>
                <a href="{{ route('checkups.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('checkups.destroy', $c->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
