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
        'email', 
        'status', 
        'training_date_time'
    ];

    const STATUS_NEW = 'new'; // When the client has just submitted a training request
    const STATUS_APPROVED = 'approved'; // Approved by the OTC but training has not yet been conducted
    const STATUS_COMPLETED = 'completed'; // The training was successfully conducted and attended by the client
    const STATUS_ABSENT = 'absent'; // The client did not attend the scheduled training
    const STATUS_REJECTED = 'rejected'; // The OTC has reviewed and denied the training request

    public function user()
    {
        return $this->belongsTo(ExternalUser::class);
    }
}