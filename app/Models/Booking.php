<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'route_name',
        'start_station',
        'end_statiion',
        'quantity',
        'time',
        'phone',
        'total',
    ];
}
