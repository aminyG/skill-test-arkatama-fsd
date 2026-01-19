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
        </tr>
        @foreach($owners as $o)
        <tr>
            <td>{{ $o->name }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ $o->phone_verified ? 'Ya' : 'Belum' }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
