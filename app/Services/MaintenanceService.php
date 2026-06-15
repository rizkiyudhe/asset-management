<?php

namespace App\Services;

use App\Models\MaintenanceRecord;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaintenanceService
{
    public function createRecord(array $data): MaintenanceRecord
    {
        return DB::transaction(function () use ($data) {
            // 1. Generate Maintenance Number secara otomatis
            $data['maintenance_number'] = $this->generateMaintenanceNumber();

            // 2. Handle Upload File Attachment jika ada
            if (isset($data['attachment'])) {
                $data['attachment'] = $data['attachment']->store('maintenance/attachments', 'public');
            }

            // 3. Simpan data record pemeliharaan
            $record = MaintenanceRecord::create($data);

            // 4. Otomatis update status aset menjadi 'maintenance'
            Asset::where('id', $data['asset_id'])->update([
                'status' => 'maintenance'
            ]);

            return $record;
        });
    }

    private function generateMaintenanceNumber(): string
    {
        $lastRecord = MaintenanceRecord::latest('id')->first();

        if (!$lastRecord) {
            return 'MNT-000001';
        }

        // Ekstrak angka dari MNT-000001, tambahkan 1, lalu pad dengan 0 sepanjang 6 digit
        $lastNumber = intval(substr($lastRecord->maintenance_number, 4));
        return 'MNT-' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    }
}
