<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopFinance extends Model
{
    /** @use HasFactory<\Database\Factories\CoopFinanceFactory> */
    use HasFactory;

    protected $table = 'coop_finances';

    protected $guarded = [];
}
