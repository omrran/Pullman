<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Passenger;


class PassengerPost extends Model
{
//    use HasFactory;
    protected $table = 'passengerposts';
    protected $fillable = [
        'id',
        'passId',//comp-12 or pass-12
        'content',
        'created_at',
        'updated_at'
    ];

    public function Passenger(){
        return $this->belongsTo('App\Models\Passenger','passId','id');
    }
}
