@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Hewan</h3>

    <form action="{{ route('pets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Data Hewan (Format: Nama Jenis Usia Berat)</label>
            <input type="text" name="raw_input" class="form-control" 
                   placeholder="Milo Kucing 2Th 4.5kg">
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <select name="owner_id" class="form-control">
                @foreach($owners as $o)
                    <option value="{{ $o->id }}">{{ $o->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
