<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sub_county_id'];

    public function subCounty()
    {
        return $this->belongsTo(SubCounty::class);
    }

    public function subLocation()
    {
        return $this->hasMany(SubLocation::class);
    }
}
