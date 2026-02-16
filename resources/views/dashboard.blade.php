@extends('layouts.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Total Pemilik</h6>
                <h2>{{ \App\Models\Owner::count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Total Hewan</h6>
                <h2>{{ \App\Models\Pet::count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Total Pemeriksaan</h6>
                <h2>{{ \App\Models\Checkup::count() }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
