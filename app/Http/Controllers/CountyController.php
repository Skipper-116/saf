<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public function getCounties()
    {
        $counties = County::all();
        return response()->json($counties);
    }
}
