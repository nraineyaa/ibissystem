<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'clientName',
        'clientAdd',
        'total',
        'grandTotal',
        'status',
        'item',
        'quantity',
        'price',
        'remark',
        'userID',
    ];
}

