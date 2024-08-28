<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantIdentifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'identifier_type_id',
        'identifier',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function identifierType()
    {
        return $this->belongsTo(IdentifierType::class);
    }
}
