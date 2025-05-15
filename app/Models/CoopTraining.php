<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CoopMembership;

class CoopTraining extends Model
{
    protected $table = 'cooptrainings';

    protected $guarded = [];

    // In CoopTraining.php
    public function memberships()
    {
        return $this->hasMany(CoopMembership::class, 'externaluser_id', 'externaluser_id');
    }

    // In CoopMembership.php
    public function generalInfo()
    {
        return $this->belongsTo(CoopGeneralInfo::class, 'externaluser_id', 'externaluser_id');
    }

    public function loans()
    {
        return $this->hasMany(CoopLoan::class, 'externaluser_id', 'externaluser_id');
    }

}
