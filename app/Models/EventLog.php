<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
//    use HasFactory;
    protected $table='eventslog';
    protected $fillable = [
        'id',
        'eventType',
        'subjectId',
        'objectId',
        'created_at',
        'updated_at'
    ];
}
