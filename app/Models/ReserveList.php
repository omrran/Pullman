<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveList extends Model
{
//    use HasFactory;
    protected $table='reservelist';
    protected $fillable = [
        'id',
        'passId',
        'tripId',
        'compName',
        'time',
        'created_at',
        'updated_at',
    ];
}
