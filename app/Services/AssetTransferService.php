<?php

namespace App\Services;

use App\Models\AssetTransfer;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class AssetTransferService
{
    public function createTransfer(array $data): AssetTransfer
    {
        return DB::transaction(function () use ($data) {
            // 1. Ambil data aset saat ini untuk mengetahui lokasi asalnya (from_location_id)
            $asset = Asset::findOrFail($data['asset_id']);
            $data['from_location_id'] = $asset->location_id;

            // 2. Catat riwayat mutasi lokasi ke tabel asset_transfers
            $transfer = AssetTransfer::create($data);

            // 3. Otomatis update lokasi terkini aset ke lokasi yang baru
            $asset->update([
                'location_id' => $data['to_location_id']
            ]);

            return $transfer;
        });
    }
}
