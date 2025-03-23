<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use app\Models\CoopGeneralInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class ExternalUser extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CanResetPasswordTrait;
    protected $table = 'externalusers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     public function coopGeneralInfo(): HasOne
    {
        return $this->hasOne(CoopGeneralInfo::class, 'externaluser_id');
    }

    public function coopMemberships()
    {
        return $this->hasMany(CoopMembership::class, 'externaluser_id', 'id');
    }

    public function coopGovernances()
    {
        return $this->hasMany(CoopGovernance::class, 'externaluser_id');
    }

    public function coopUnits()
    {
        return $this->hasMany(CoopUnit::class, 'externaluser_id');
    }

    public function coopFranchises()
    {
        return $this->hasMany(CoopFranchise::class, 'externaluser_id');
    }

    public function coopFinances()
    {
        return $this->hasOne(CoopFinance::class, 'externaluser_id');
    }

    public function coopLoans()
    {
        return $this->hasMany(CoopLoan::class, 'externaluser_id');
    }

    public function coopBusinesses()
    {
        return $this->hasMany(CoopBusiness::class, 'externaluser_id');
    }

    public function coopCetos()
    {
        return $this->hasMany(CoopCetos::class, 'externaluser_id');
    }

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function routeNotificationForVonage($notification = null)
{
    if ($notification instanceof \App\Notifications\SendOtpNotification && 
        property_exists($notification, 'contactNo') && 
        $notification->contactNo) {
        return $notification->contactNo;
    }
    
    return $this->contact_no;
}

}
