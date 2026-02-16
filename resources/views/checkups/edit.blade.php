@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Pemeriksaan</h3>

    <form action="{{ route('checkups.update', $checkup->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Hewan</label>
            <select name="pet_id" class="form-control">
                @foreach($pets as $p)
                    <option value="{{ $p->id }}" {{ $checkup->pet_id == $p->id ? 'selected' : '' }}>
                        {{ $p->name }} - {{ $p->owner->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Perawatan</label>
            <select name="treatment_id" class="form-control">
                @foreach($treatments as $t)
                    <option value="{{ $t->id }}" {{ $checkup->treatment_id == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="checkup_date" class="form-control" value="{{ $checkup->checkup_date }}">
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="notes" class="form-control">{{ $checkup->notes }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
