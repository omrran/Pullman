<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
//    use HasFactory;
    protected $table='comments';
    protected $fillable = [
        'id',
        'actorId',
        'content',
        'postId',
        'created_at',
        'updated_at'
    ];
}
