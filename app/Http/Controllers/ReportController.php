<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Exports\AssetsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function assets(Request $request)
    {
        // Ambil data untuk dropdown filter
        $categories = Category::all();
        $locations = Location::all();

        // Bangun Query dengan Filter Dinamis
        $query = Asset::with(['category', 'location']);

        $query->when($request->category_id, function ($q, $category_id) {
            return $q->where('category_id', $category_id);
        });

        $query->when($request->location_id, function ($q, $location_id) {
            return $q->where('location_id', $location_id);
        });

        $query->when($request->status, function ($q, $status) {
            return $q->where('status', $status);
        });

        $query->when($request->start_date && $request->end_date, function ($q) use ($request) {
            return $q->whereBetween('purchase_date', [$request->start_date, $request->end_date]);
        });

        // Eksekusi ekspor jika tombol ditekan
        if ($request->action === 'export_excel') {
            return Excel::download(new AssetsExport($query->get()), 'Laporan_Aset_' . date('Ymd') . '.xlsx');
        }

        if ($request->action === 'export_pdf') {
            $assets = $query->get();
            $pdf = Pdf::loadView('reports.pdf_assets', compact('assets'))->setPaper('a4', 'landscape');
            return $pdf->download('Laporan_Aset_' . date('Ymd') . '.pdf');
        }

        // Tampilkan ke halaman view dengan pagination
        $assets = $query->latest()->paginate(20)->withQueryString();

        return view('reports.assets', compact('assets', 'categories', 'locations'));
    }
}
