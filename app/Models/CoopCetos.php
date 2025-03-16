<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopCetos extends Model
{
    /** @use HasFactory<\Database\Factories\CoopCetosFactory> */
    use HasFactory;

    protected $table = 'coop_cetos';

    protected $guarded = [];
}
