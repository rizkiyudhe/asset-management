<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetTransfer extends Model
{
    /** @use HasFactory<\Database\Factories\AssetTransferFactory> */
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['transfer_date' => 'date'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }
    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }
}
