<?php

namespace App\Http\Controllers;

use App\Models\SubCounty;
use Illuminate\Http\Request;

class SubCountyController extends Controller
{
    public function getSubCounties()
    {
        $subCounties = SubCounty::all();
        return response()->json($subCounties);
    }

    public function getSubCounty($id)
    {
        $subCounty = SubCounty::find($id);
        return response()->json($subCounty);
    }

    public function getSubCountiesByCounty($county_id)
    {
        $subCounties = SubCounty::where('county_id', $county_id)->get();
        return response()->json($subCounties);
    }
}
