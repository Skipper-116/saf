<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function getVillages()
    {
        $villages = Village::all();
        return response()->json($villages);
    }

    public function getVillagesBySubLocation($subLocationId)
    {
        $villages = Village::where('sub_location_id', $subLocationId)->get();
        return response()->json($villages);
    }

    public function getVillage($id)
    {
        $village = Village::find($id);
        return response()->json($village);
    }

    public function create(Request $request)
    {
        $village = new Village();
        $village->name = $request->name;
        $village->sub_location_id = $request->sub_location_id;
        $village->save();
        return response()->json($village);
    }

    public function update(Request $request, $id)
    {
        $village = Village::find($id);
        $village->name = $request->name;
        $village->sub_location_id = $request->sub_location_id;
        $village->save();
        return response()->json($village);
    }

    public function delete($id)
    {
        $village = Village::find($id);
        $village->delete();
        return response()->json('Removed successfully');
    }
}
