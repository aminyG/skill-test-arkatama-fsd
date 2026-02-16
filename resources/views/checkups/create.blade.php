@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Pemeriksaan</h3>

    <form action="{{ route('checkups.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Hewan</label>
            <select name="pet_id" class="form-control">
                @foreach($pets as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} - {{ $p->owner->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Perawatan</label>
            <select name="treatment_option" id="treatment_option" class="form-control" onchange="toggleNewTreatment()">
                <option value="">-- Pilih Treatment --</option>
                @foreach($treatments as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
                <option value="new">+ Tambah Treatment Baru</option>
            </select>
        </div>

        <div class="mb-3 d-none" id="new_treatment_div">
            <label>Nama Treatment Baru</label>
            <input type="text" name="new_treatment" class="form-control" placeholder="Contoh: Vaksin, Grooming, Pemeriksaan">
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="checkup_date" class="form-control">
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
function toggleNewTreatment() {
    let select = document.getElementById('treatment_option');
    let div = document.getElementById('new_treatment_div');

    if (select.value === 'new') {
        div.classList.remove('d-none');
    } else {
        div.classList.add('d-none');
    }
}
</script>
@endsection
