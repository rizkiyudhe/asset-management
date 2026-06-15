<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceRecordFactory> */
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['maintenance_date' => 'date', 'cost' => 'decimal:2'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
