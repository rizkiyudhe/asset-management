<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\MaintenanceRecordController;
use App\Http\Controllers\DisposalRecordController;
use App\Http\Controllers\AssetTransferController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Models\Asset;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // Dashboard (Bisa diakses semua role yang login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('locations', LocationController::class)->except(['show']);
    });

    // Grouping Routes untuk Admin dan Staff Asset
    Route::middleware('role:admin,staff_asset')->group(function () {
        Route::resource('assets', AssetController::class);
        Route::get('/assets/{asset}/qr/download', function (Asset $asset) {
            $path = storage_path('app/public/assets/qrcodes/' . $asset->asset_code . '.svg');
            return response()->download($path);
        })->name('assets.qr.download');

        Route::resource('maintenances', MaintenanceRecordController::class)->except(['edit', 'update']);
        Route::resource('transfers', AssetTransferController::class)->only(['index', 'create', 'store']);
        Route::resource('disposals', DisposalRecordController::class)->only(['index', 'create', 'store']);
    });

    Route::middleware('role:admin,manager')->group(function () {
        Route::get('/reports/assets', [ReportController::class, 'assets'])->name('reports.assets');
    });
});

require __DIR__ . '/auth.php';
