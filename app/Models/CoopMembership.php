<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopMembership extends Model
{
    /** @use HasFactory<\Database\Factories\CoopMembershipFactory> */
    use HasFactory;

    protected $table = 'members_masterlist';

    protected $guarded = [];
}
