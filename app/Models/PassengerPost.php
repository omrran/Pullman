<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function passenger(){
        return $this->belongsTo('app\Models\Passenger','passId');
    }
}
