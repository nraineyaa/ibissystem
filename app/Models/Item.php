<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'id',
        'bil',
        'itemName',
        'quantity',
        'price',
        'amount',
        'userID',
    ];
}
