<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'training_type', 
        'letter_of_intent', 
        'cda_reg_no', 
        'reference_no', 
        'status', 
        'training_date_time'
    ];

    const STATUS_NEW = 'new';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public function user()
    {
        return $this->belongsTo(ExternalUser::class);
    }
}