<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
//    use HasFactory;
    protected $table = 'eventsLog';
    protected $fillable = [
        'id',
        'eventType',
        'actorType',
        'actorId',
        'objectId',
        'objectType',
        'created_at',
        'updated_at'
    ];
}

