<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRecord;
use App\Models\Asset;
use App\Services\MaintenanceService;
use App\Http\Requests\StoreMaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaintenanceRecordController extends Controller
{
    public function __construct(
        protected MaintenanceService $maintenanceService
    ) {}

    public function index()
    {
        $records = MaintenanceRecord::with('asset')
            ->latest()
            ->paginate(10);

        return view('maintenances.index', compact('records'));
    }

    public function create(Request $request)
    {
        // Jika diakses via tombol dari halaman detail aset, set auto-select asset_id
        $selectedAssetId = $request->query('asset_id');

        // Hanya aset yang tidak berstatus 'disposed' yang bisa di-maintenance
        $assets = Asset::where('status', '!=', 'disposed')->get();

        return view('maintenances.create', compact('assets', 'selectedAssetId'));
    }

    public function store(StoreMaintenanceRequest $request)
    {
        $this->maintenanceService->createRecord($request->validated());

        return redirect()->route('maintenances.index')
            ->with('success', 'Catatan pemeliharaan berhasil dibuat dan status aset telah diperbarui.');
    }

    public function show(MaintenanceRecord $maintenance)
    {
        $maintenance->load('asset');
        return view('maintenances.show', compact('maintenance'));
    }

    public function destroy(MaintenanceRecord $maintenance)
    {
        if ($maintenance->attachment) {
            Storage::disk('public')->delete($maintenance->attachment);
        }

        $maintenance->delete();

        return redirect()->route('maintenances.index')
            ->with('success', 'Catatan pemeliharaan berhasil dihapus.');
    }
}
