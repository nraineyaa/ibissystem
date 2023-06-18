<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $table = 'report'; //table to store activity data
    protected $fillable = [
        'reportTitle',
        'filePath',
        'date',
        'file',
        'remark',
        'status',
        'userID',
    ];
}
