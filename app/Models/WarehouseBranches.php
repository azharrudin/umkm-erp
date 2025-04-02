<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseBranches extends Model
{
    use HasFactory;
    protected $table = 'warehouse_branches';
    protected $guarded = [];
    public function logs()
    {
        return $this->hasMany(WarehouseLogs::class, 'branch_id');
    }
}
