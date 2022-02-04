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
        'imagePath',
        'created_at',
        'updated_at'
    ];
    public function passengerPosts(){
        return $this->hasMany('app\Models\PassengerPost','passId','id');
    }
}
