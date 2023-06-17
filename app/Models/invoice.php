<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices'; //table to store activity data
    protected $fillable = [
        'id',
        'issueDate',
        'totalAmount',
        'dueDate',
        'address',
        'payment',
        'remark',
        'userID',
        'itemID',
        'compID',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
