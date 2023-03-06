<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $table = 'stations';
    protected $fillable = [
        'route_id',
        'station_name',
        'order',
    ];
}
