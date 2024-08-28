<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'application_date',
        'collected_by',
        'collected_date',
        'village_id'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function collector()
    {
        return $this->belongsTo(User::class, 'collected_by');
    }

    public function socialProgrammes()
    {
        return $this->hasMany(ApplicationSocialProgramme::class, 'application_id');
    }
}
