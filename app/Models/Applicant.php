<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex_id',
        'date_of_birth',
        'marital_status_id',
        'physical_address',
        'postal_address',
        'creator',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function age()
    {
        return $this->date_of_birth->age;
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function telephones()
    {
        return $this->hasMany(ApplicantTelephone::class);
    }

    public function identifiers()
    {
        return $this->hasMany(ApplicantIdentifier::class);
    }
}
