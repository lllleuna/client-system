<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CoopMembership;

class CoopGeneralInfo extends Model
{
    /** @use HasFactory<\Database\Factories\CoopGeneralInfoFactory> */
    use HasFactory;

    protected $table = 'coop_info';

    protected $guarded = [];

    public function coopMembership(): HasMany
    {
        return $this->hasMany(CoopMembership::class, 'coop_info_id');
    }
}
