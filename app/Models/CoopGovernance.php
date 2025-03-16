<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopGovernance extends Model
{
    /** @use HasFactory<\Database\Factories\CoopGovernanceFactory> */
    use HasFactory;

    protected $table = 'governance_list';

    protected $guarded = [];
}
