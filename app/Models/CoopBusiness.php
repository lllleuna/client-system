<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopBusiness extends Model
{
    /** @use HasFactory<\Database\Factories\CoopBusinessFactory> */
    use HasFactory;

    protected $table = 'coop_businesses';

    protected $guarded = [];
}
