<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sub_location_id'];

    public function subLocation()
    {
        return $this->belongsTo(SubLocation::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
