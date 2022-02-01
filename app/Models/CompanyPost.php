<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPost extends Model
{
//    use HasFactory;
    protected $table='companyposts';
    protected $fillable = [
        'id',
        'compId',
        'content',
        'created_at',
        'updated_at'
    ];

    public function company(){
        return $this->belongsTo('app\Models\Company','compId');
    }
}
