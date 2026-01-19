<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Pet;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::all();
        return view('pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Owner::where('phone_verified', true)->get();
        return view('pets.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'raw_input' => 'required',
            'owner_id' => 'required|exists:owners,id'
        ]);

        $raw = trim(preg_replace('/\s+/', ' ', $request->raw_input));
        $parts = explode(' ', $raw);

        if (count($parts) < 4) {
            return back()->withErrors(['Format input tidak sesuai. Gunakan: Nama Jenis Usia Berat']);
        }

        $name = strtoupper($parts[0]);
        $species = strtoupper($parts[1]);

        $ageRaw = $parts[2];
        $weightRaw = $parts[3];

        if (!preg_match('/(\d+)/', $ageRaw, $ageMatch)) {
            return back()->withErrors(['Format usia tidak valid']);
        }
        $age = (int) $ageMatch[1];


        $weightClean = strtolower($weightRaw);
        $weightClean = str_replace(['kg', ' '], '', $weightClean);
        $weightClean = str_replace(',', '.', $weightClean);

        if (!is_numeric($weightClean)) {
            return back()->withErrors(['Format berat tidak valid']);
        }
        $weight = (float) $weightClean;


        $exists = Pet::where('owner_id', $request->owner_id)
            ->where('name', $name)
            ->where('species', $species)
            ->exists();

        if ($exists) {
            return back()->withErrors(['Hewan dengan nama dan jenis yang sama sudah ada untuk pemilik ini']);
        }


        $time = now()->format('Hi'); // HHMM
        $ownerId = str_pad($request->owner_id, 4, '0', STR_PAD_LEFT);

        $lastNumber = Pet::count() + 1;
        $sequence = str_pad($lastNumber, 4, '0', STR_PAD_LEFT);

        $code = $time . $ownerId . $sequence;

        
        Pet::create([
            'owner_id' => $request->owner_id,
            'code' => $code,
            'name' => $name,
            'species' => $species,
            'age' => $age,
            'weight' => $weight
        ]);

        return redirect()->route('pets.index')->with('success', 'Data hewan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
