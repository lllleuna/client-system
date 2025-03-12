<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopLoan extends Model
{
    /** @use HasFactory<\Database\Factories\CoopLoanFactory> */
    use HasFactory;

    protected $table = 'coop_loans';

    protected $guarded = [];
}
