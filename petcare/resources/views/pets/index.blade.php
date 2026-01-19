@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Hewan</h3>
    <a href="{{ route('pets.create') }}" class="btn btn-primary mb-3">Tambah Hewan</a>

    <table class="table table-hover shadow-sm bg-white rounded">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Usia</th>
            <th>Berat (kg)</th>
            <th>Pemilik</th>
            <th>Aksi</th>
        </tr>
        @foreach($pets as $p)
        <tr>
            <td>{{ $p->code }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->species }}</td>
            <td>{{ $p->age }}</td>
            <td>{{ $p->weight }}</td>
            <td>{{ $p->owner->name }}</td>
            <td>
                <a href="{{ route('pets.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pets.destroy', $p->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
