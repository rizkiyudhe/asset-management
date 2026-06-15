<?php

namespace App\Services;

use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetService
{
    public function createAsset(array $data): Asset
    {
        return DB::transaction(function () use ($data) {
            // 1. Generate Asset Code secara otomatis
            $data['asset_code'] = $this->generateAssetCode();

            // 2. Handle Image Upload jika ada
            if (isset($data['image'])) {
                $data['image'] = $data['image']->store('assets/images', 'public');
            }

            // 3. Simpan data ke database
            $asset = Asset::create($data);

            // 4. Generate QR Code
            $this->generateQrCode($asset);

            return $asset;
        });
    }

    public function updateAsset(Asset $asset, array $data): Asset
    {
        return DB::transaction(function () use ($asset, $data) {
            if (isset($data['image'])) {
                // Hapus gambar lama jika ada
                if ($asset->image) {
                    Storage::disk('public')->delete($asset->image);
                }
                $data['image'] = $data['image']->store('assets/images', 'public');
            }

            $asset->update($data);
            return $asset;
        });
    }

    private function generateAssetCode(): string
    {
        $lastAsset = Asset::latest('id')->first();

        if (!$lastAsset) {
            return 'AST-000001';
        }

        // Ekstrak angka dari AST-000001, tambahkan 1, lalu pad dengan 0
        $lastNumber = intval(substr($lastAsset->asset_code, 4));
        return 'AST-' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    }

    private function generateQrCode(Asset $asset): void
    {
        // Asumsi route 'assets.show' akan dibuat nanti di controller
        $url = route('assets.show', $asset->id);
        $directory = 'assets/qrcodes';
        $path = $directory . '/' . $asset->asset_code . '.svg';

        // Buat folder jika belum ada
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Generate dan simpan QR Code
        QrCode::size(300)
            ->format('svg')
            ->generate($url, storage_path('app/public/' . $path));
    }
}
