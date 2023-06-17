<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    protected $table = 'item'; //table to store activity data

    protected $fillable = [
        'id',
        'invID',
        'itemName',
        'quantity',
        'price',
        'amount',
        'userID',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
