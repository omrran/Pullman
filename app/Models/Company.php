<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // use HasFactory; // <<====== this thing new in laravel 8 ;
    protected $table='company';
    protected $fillable = [
        'id',
        'compName',
        'email',
        'telephone',
        'address',
        'password',
        'status',
        'created_at',
        'updated_at'
    ];

    public function companyPosts(){
        return $this->hasMany('App\Models\CompanyPost','compId','id');
    }

    public function companyTrips(){
        return $this->hasMany('App\Models\Trip','compId','id');
    }



}
