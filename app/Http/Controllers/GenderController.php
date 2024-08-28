<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function getGenders()
    {
        $genders = Gender::all();
        return response()->json($genders);
    }
}
