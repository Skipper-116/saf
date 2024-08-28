<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLocation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
