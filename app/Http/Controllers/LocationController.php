<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // withCount untuk menampilkan jumlah aset di tiap kategori
        $locations = Location::withCount('assets')->latest()->paginate(10);
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'description' => 'nullable|string'
        ]);

        Location::create($validated);
        return redirect()->route('locations.index')->with('success', 'lokasi baru berhasil ditambahkan.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
            'description' => 'nullable|string'
        ]);

        $location->update($validated);
        return redirect()->route('locations.index')->with('success', 'Data lokasi diperbarui.');
    }

    public function destroy(Location $location)
    {
        if ($location->assets()->count() > 0) {
            return back()->with('error', 'Lokasi tidak dapat dihapus karena masih digunakan oleh aset.');
        }

        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
