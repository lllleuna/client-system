<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopFranchise extends Model
{
    /** @use HasFactory<\Database\Factories\CoopFranchiseFactory> */
    use HasFactory;

    protected $table = 'coop_franchises';

    protected $guarded = [];
}
