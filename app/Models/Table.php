<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    protected $fillable = ['name','status','capacity','zone'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // Réservations actives du jour
    public function todayReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)
                    ->whereDate('reservation_date', today())
                    ->where('status', 'confirmed');
    }
}
