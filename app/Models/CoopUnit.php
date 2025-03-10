<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopUnit extends Model
{
    /** @use HasFactory<\Database\Factories\CoopUnitFactory> */
    use HasFactory;

    protected $table = 'coop_units';

    protected $guarded = [];
}
