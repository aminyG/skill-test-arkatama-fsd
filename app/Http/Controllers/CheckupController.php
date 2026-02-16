<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Treatment;
use App\Models\Checkup;

class CheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkups = Checkup::with(['pet.owner', 'treatment'])->get();
        return view('checkups.index', compact('checkups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pets = Pet::all();
        $treatments = Treatment::all();
        return view('checkups.create', compact('pets','treatments'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required',
            'checkup_date' => 'required|date',
        ]);

        if ($request->treatment_option === 'new') {
            $request->validate([
                'new_treatment' => 'required|string'
            ]);

            $treatment = Treatment::create([
                'name' => strtoupper($request->new_treatment)
            ]);

            $treatmentId = $treatment->id;
        } else {
            $treatmentId = $request->treatment_option;
        }

        Checkup::create([
            'pet_id' => $request->pet_id,
            'treatment_id' => $treatmentId,
            'checkup_date' => $request->checkup_date,
            'notes' => $request->notes
        ]);

        return redirect()->route('checkups.index')->with('success', 'Pemeriksaan berhasil disimpan');
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
        $checkup = Checkup::findOrFail($id);
        $pets = Pet::all();
        $treatments = Treatment::all();
        return view('checkups.edit', compact('checkup','pets','treatments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pet_id' => 'required',
            'treatment_id' => 'required',
            'checkup_date' => 'required|date'
        ]);

        $checkup = Checkup::findOrFail($id);
        $checkup->update($request->all());

        return redirect()->route('checkups.index')->with('success','Data pemeriksaan diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Checkup::findOrFail($id)->delete();
        return redirect()->route('checkups.index')->with('success','Data pemeriksaan dihapus');
    }
}
