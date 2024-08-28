<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialProgram extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function application_programmes()
    {
        return $this->hasMany(ApplicationSocialProgramme::class);
    }
}
