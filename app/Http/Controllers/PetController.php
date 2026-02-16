<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Pet;

class PetController extends Controller
{
    private function parsePetInput($raw)
    {
        $raw = trim(preg_replace('/\s+/', ' ', $raw));
        $parts = explode(' ', $raw);

        if (count($parts) < 4) {
            return null;
        }

        $name = $parts[0];
        $species = $parts[1];

        $agePart = $parts[2];
        $weightPart = $parts[3];

        if (!preg_match('/(\d+)/', $agePart, $ageMatch)) {
            return null;
        }
        $age = (int)$ageMatch[1];

        $weight = strtolower($weightPart);
        $weight = str_replace(['kg', ' '], '', $weight);
        $weight = str_replace(',', '.', $weight);

        if (!is_numeric($weight)) {
            return null;
        }

        return [
            'name' => $name,
            'species' => $species,
            'age' => $age,
            'weight' => (float)$weight
        ];
    }


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

        $result = $this->parsePetInput($request->raw_input);
        if (!$result) {
            return back()->withErrors(['Format input tidak valid. Gunakan: Nama Jenis Usia Berat']);
        }

        $name = strtoupper($result['name']);
        $species = strtoupper($result['species']);
        $age = $result['age'];
        $weight = $result['weight'];

        $exists = Pet::where('owner_id', $request->owner_id)
            ->where('name', $name)
            ->where('species', $species)
            ->exists();

        if ($exists) {
            return back()->withErrors(['Hewan dengan nama dan jenis yang sama sudah ada untuk pemilik ini']);
        }

        $time = now()->format('Hi');
        $ownerId = str_pad($request->owner_id, 4, '0', STR_PAD_LEFT);
        $sequence = str_pad(Pet::where('owner_id', $request->owner_id)->count() + 1, 4, '0', STR_PAD_LEFT);

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
        $pet = Pet::findOrFail($id);
        $owners = Owner::where('phone_verified', 1)->get();
        return view('pets.edit', compact('pet','owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'raw_input' => 'required',
            'owner_id' => 'required'
        ]);

        $result = $this->parsePetInput($request->raw_input);
        if (!$result) {
            return back()->withErrors(['Format input tidak valid. Gunakan: Nama Jenis Usia Berat']);
        }


        $pet = Pet::findOrFail($id);
        $pet->update([
            'name' => strtoupper($result['name']),
            'species' => strtoupper($result['species']),
            'age'  => $result['age'],
            'weight' => $result['weight'],
            'owner_id' => $request->owner_id
        ]);

        return redirect()->route('pets.index')->with('success','Data hewan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pet::findOrFail($id)->delete();
        return redirect()->route('pets.index')->with('success','Data hewan berhasil dihapus');
    }
}
