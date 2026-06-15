<?php

namespace App\Services;

use App\Models\DisposalRecord;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class DisposalService
{
    public function createDisposal(array $data): DisposalRecord
    {
        return DB::transaction(function () use ($data) {
            // 1. Simpan catatan pembuangan/penjualan
            $disposal = DisposalRecord::create($data);

            // 2. Ubah status aset menjadi disposed agar tidak muncul lagi di operasi aktif
            Asset::where('id', $data['asset_id'])->update([
                'status' => 'disposed'
            ]);

            return $disposal;
        });
    }
}
