@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Data Hewan</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pets.update', $pet->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Format Input Hewan</label>
            <input type="text" name="raw_input" class="form-control"
                   value="{{ $pet->name }} {{ $pet->species }} {{ $pet->age }}Th {{ $pet->weight }}Kg">
            <small class="text-muted">Contoh: Milo Kucing 2Th 4.5kg</small>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <select name="owner_id" class="form-control">
                @foreach($owners as $o)
                    <option value="{{ $o->id }}" {{ $pet->owner_id == $o->id ? 'selected' : '' }}>
                        {{ $o->name }} ({{ $o->phone }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
