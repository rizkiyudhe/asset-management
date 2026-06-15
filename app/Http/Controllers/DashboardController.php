<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\MaintenanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Cards (Statistik Cepat)
        $stats = [
            'total_assets' => Asset::where('status', '!=', 'disposed')->count(),
            'active_assets' => Asset::where('status', 'active')->count(),
            'maintenance_assets' => Asset::where('status', 'maintenance')->count(),
            'damaged_assets' => Asset::whereIn('status', ['damaged', 'lost'])->count(),
            'total_categories' => Category::count(),
            'total_locations' => Location::count(),
        ];

        // 2. Data Chart: Aset per Kategori
        $assetsByCategory = Category::withCount(['assets' => function ($query) {
            $query->where('status', '!=', 'disposed');
        }])->get();

        $categoryLabels = $assetsByCategory->pluck('name');
        $categoryData = $assetsByCategory->pluck('assets_count');

        // 3. Data Chart: Biaya Maintenance per Bulan (Tahun Berjalan)
        $currentYear = date('Y');
        $monthlyCostsRaw = MaintenanceRecord::select(
            DB::raw('MONTH(maintenance_date) as month'),
            DB::raw('SUM(cost) as total_cost')
        )
            ->whereYear('maintenance_date', $currentYear)
            ->groupBy('month')
            ->pluck('total_cost', 'month');

        // Format array agar selalu berjumlah 12 bulan (isi 0 jika tidak ada biaya)
        $monthlyCosts = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyCosts[] = $monthlyCostsRaw->has($i) ? $monthlyCostsRaw[$i] : 0;
        }

        // 4. Data Tabel: Aset & Maintenance Terbaru
        $recentAssets = Asset::with(['category', 'location'])->latest()->take(5)->get();
        $recentMaintenances = MaintenanceRecord::with('asset')->latest()->take(5)->get();

        return view('dashboard', compact(
            'stats',
            'categoryLabels',
            'categoryData',
            'monthlyCosts',
            'currentYear',
            'recentAssets',
            'recentMaintenances'
        ));
    }
}
