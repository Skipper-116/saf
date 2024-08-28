<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    public function getMaritalStatuses()
    {
        $maritalStatuses = MaritalStatus::all();
        return response()->json($maritalStatuses);
    }
}
