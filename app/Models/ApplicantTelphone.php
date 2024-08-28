<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantTelphone extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'telephone',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
