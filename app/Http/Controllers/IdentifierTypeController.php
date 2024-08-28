<?php

namespace App\Http\Controllers;

use App\Models\IdentifierType;
use Illuminate\Http\Request;

class IdentifierTypeController extends Controller
{
    public function getIdentifierTypes()
    {
        $identifierTypes = IdentifierType::all();
        return response()->json($identifierTypes);
    }
}
