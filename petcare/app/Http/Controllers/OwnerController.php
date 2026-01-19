<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owner::all();
        return view('owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Owner::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'phone_verified' => $request->has('phone_verified')
        ]);

        return redirect()->route('owners.index')->with('success', 'Owner berhasil ditambahkan');
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
        $owner = Owner::findOrFail($id);
        return view('owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $owner = Owner::findOrFail($id);
        $owner->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'phone_verified' => $request->has('phone_verified')
        ]);

        return redirect()->route('owners.index')->with('success', 'Owner berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Owner::findOrFail($id)->delete();
        return redirect()->route('owners.index')->with('success','Owner berhasil dihapus');
    }
}
