<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseLogs extends Model
{
    use HasFactory;
    protected $table = 'warehouse_logs';
    protected $guarded = [];
    public function item()
    {
        return $this->belongsTo(WarehouseModule::class, 'item_id');
    }

    public function branch()
    {
        return $this->belongsTo(WarehouseBranches::class, 'branch_id');
    }

}
