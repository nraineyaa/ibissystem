<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joinactv extends Model
{
    use HasFactory;
    protected $table = 'joinactv';

    protected $fillable = [
        'id',
        'userID',
        'activityID',
    ];
}
