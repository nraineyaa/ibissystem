<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $table = 'claims'; //table to store activity data

    //attributes in the table
    protected $fillable = [
        'id',
        'date',
        'claimType',
        'svName',
        'amount',
        'status	',
        'remark',
        'userID',
    ];
}
