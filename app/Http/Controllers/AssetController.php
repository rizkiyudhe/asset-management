<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Services\AssetService;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function __construct(
        protected AssetService $assetService
    ) {}

    public function index(Request $request)
    {
        // Fitur pencarian sederhana bisa ditambahkan di sini nantinya
        $assets = Asset::with(['category', 'location'])
            ->latest()
            ->paginate(10);

        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();

        return view('assets.create', compact('categories', 'locations'));
    }

    public function store(StoreAssetRequest $request)
    {
        $this->assetService->createAsset($request->validated());

        return redirect()->route('assets.index')
            ->with('success', 'Aset baru berhasil ditambahkan dan QR Code telah di-generate.');
    }

    public function show(Asset $asset)
    {
        $asset->load(['category', 'location', 'maintenanceRecords']);
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $locations = Location::all();

        return view('assets.edit', compact('asset', 'categories', 'locations'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $this->assetService->updateAsset($asset, $request->validated());

        return redirect()->route('assets.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        // Soft delete
        $asset->delete();

        return redirect()->route('assets.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }
}
