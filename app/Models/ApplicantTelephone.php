<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantTelephone extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'telephone',
        'creator',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
