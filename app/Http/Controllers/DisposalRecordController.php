<?php

namespace App\Http\Controllers;

use App\Models\DisposalRecord;
use App\Models\Asset;
use App\Services\DisposalService;
use App\Http\Requests\StoreDisposalRequest;
use Illuminate\Http\Request;

class DisposalRecordController extends Controller
{
    public function __construct(protected DisposalService $disposalService) {}

    public function index()
    {
        $disposals = DisposalRecord::with('asset')->latest()->paginate(10);
        return view('disposals.index', compact('disposals'));
    }

    public function create()
    {
        // Hanya aset yang belum di-dispose yang bisa dihapusbukukan
        $assets = Asset::where('status', '!=', 'disposed')->get();
        return view('disposals.create', compact('assets'));
    }

    public function store(StoreDisposalRequest $request)
    {
        $this->disposalService->createDisposal($request->validated());
        return redirect()->route('disposals.index')
            ->with('success', 'Aset berhasil dihapusbukukan (Disposed) secara permanen dari operasi.');
    }
}
