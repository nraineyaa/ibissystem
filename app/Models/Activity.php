<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity'; //table to store activity data

    //attributes in the table
    protected $fillable = [
        'id',
        'activityName',
        'activityDesc',
        'activityCap',
        'activityDate',
        'activityVenue',
        'activityStatus',
        'activityFile',
    ];

    // protected $attributes = [
    //     'activityStatus' => 'Submitted'
    // ];
}
