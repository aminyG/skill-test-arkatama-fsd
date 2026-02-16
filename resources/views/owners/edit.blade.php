@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Pemilik</h3>

    <form action="{{ route('owners.update', $owner->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $owner->name }}">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="phone" class="form-control" value="{{ $owner->phone }}">
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="phone_verified" value="1"
                {{ $owner->phone_verified ? 'checked' : '' }}>
            <label class="form-check-label">Nomor HP Terverifikasi</label>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
