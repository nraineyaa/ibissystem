<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model for proposal in database
class Proposal extends Model
{
    protected $table = 'proposal';

    protected $fillable = [
        'id',
        'userID',
        'proposalName',
        'proposalLocation',
        'proposalDate',
        'proposalBudget',
        'proposalPax',
        'proposalParticipant',
        'proposalDoc',
        'proposalStatus',
        'proposalComment',
    ];
}
