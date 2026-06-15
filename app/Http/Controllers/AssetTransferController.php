<?php

namespace App\Http\Controllers;

use App\Models\AssetTransfer;
use App\Models\Asset;
use App\Models\Location;
use App\Services\AssetTransferService;
use App\Http\Requests\StoreAssetTransferRequest;
use Illuminate\Http\Request;

class AssetTransferController extends Controller
{
    public function __construct(
        protected AssetTransferService $transferService
    ) {}

    public function index()
    {
        $transfers = AssetTransfer::with(['asset', 'fromLocation', 'toLocation'])
            ->latest()
            ->paginate(10);

        return view('transfers.index', compact('transfers'));
    }

    public function create(Request $request)
    {
        $selectedAssetId = $request->query('asset_id');

        // Hanya aset aktif yang bisa dimutasi lokasinya
        $assets = Asset::where('status', 'active')->get();
        $locations = Location::all();

        return view('transfers.create', compact('assets', 'locations', 'selectedAssetId'));
    }

    public function store(StoreAssetTransferRequest $request)
    {
        $this->transferService->createTransfer($request->validated());

        return redirect()->route('transfers.index')
            ->with('success', 'Aset berhasil dimutasi dan lokasi terkini aset telah diperbarui.');
    }
}
