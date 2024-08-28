<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSocialProgramme extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'social_programme_id',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function socialProgramme()
    {
        return $this->belongsTo(SocialProgram::class, 'social_programme_id');
    }
}
