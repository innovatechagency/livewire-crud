<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{

    protected $fillable = ['table_id','guest_name','guest_phone','reservation_date','reservation_time','guest_count','status'];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }
    
}
