<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table='trips';
    protected $fillable = [
        'id',
        'compId',
        'from',
        'to',
        'numSeats',
        'time',
        'priceASeat',
        'status',
        'created_at',
        'updated_at',
    ];

    public function company(){
        return $this->belongsTo('app\Models\Company','compId');
    }

}
