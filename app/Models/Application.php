<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    protected $guarded = '';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            // Generate reference number only if it does not exist
            if (empty($application->reference_number)) {
                $application->reference_number = 'APP-' . str_pad(Application::max('id') + 1, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    public function coopInfo()
    {
        return $this->belongsTo(CoopGeneralInfo::class, 'user_id', 'externaluser_id');
    }

    public function appgeneralinfo()
    {
        return $this->hasMany(AppGeneralInfo::class, 'user_id', 'externaluser_id');
    }
}
