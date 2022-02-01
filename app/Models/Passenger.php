<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
//    use HasFactory;

    protected $table='passenger';
    protected $fillable = [
        'id',
        'fName',
        'lName',
        'phone',
        'idn',
        'password',
        'status',
        'created_at',
        'updated_at'
    ];
    public function passengerPost(){
        return $this->hasOne('app\Models\PassengerPost','passId');
    }
}
