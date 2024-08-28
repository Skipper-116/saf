<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'marital_status_id', 'id');
    }
}
