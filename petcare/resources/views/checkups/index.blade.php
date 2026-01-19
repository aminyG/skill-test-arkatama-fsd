@extends('layouts.app')

@section('content')
<h3 class="mb-3">Data Pemeriksaan</h3>

<a href="{{ route('checkups.create') }}" class="btn btn-primary mb-3">Tambah Pemeriksaan</a>

<table class="table table-hover shadow-sm bg-white rounded">
    <thead class="table-light">
        <tr>
            <th>Tanggal</th>
            <th>Kode Hewan</th>
            <th>Nama Hewan</th>
            <th>Pemilik</th>
            <th>Jenis Perawatan</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checkups as $c)
        <tr>
            <td>{{ $c->checkup_date }}</td>
            <td>{{ $c->pet->code }}</td>
            <td>{{ $c->pet->name }}</td>
            <td>{{ $c->pet->owner->name }}</td>
            <td>{{ $c->treatment->name }}</td>
            <td>{{ $c->notes ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
