<?php

namespace App\Http\Controllers;

use App\Models\SubLocation;
use Illuminate\Http\Request;

class SubLocationController extends Controller
{
    public function getSubLocations()
    {
        $subLocations = SubLocation::all();
        return response()->json($subLocations);
    }

    public function getSubLocation($id)
    {
        $subLocation = SubLocation::find($id);
        return response()->json($subLocation);
    }

    public function getSubLocationsByLocation($location_id)
    {
        $subLocations = SubLocation::where('location_id', $location_id)->get();
        return response()->json($subLocations);
    }

    public function createSubLocation(Request $request)
    {
        $subLocation = new SubLocation();
        $subLocation->name = $request->name;
        $subLocation->location_id = $request->location_id;
        $subLocation->save();
        return response()->json($subLocation);
    }

    public function updateSubLocation(Request $request, $id)
    {
        $subLocation = SubLocation::find($id);
        $subLocation->name = $request->name;
        $subLocation->location_id = $request->location_id;
        $subLocation->save();
        return response()->json($subLocation);
    }

    public function deleteSubLocation($id)
    {
        $subLocation = SubLocation::find($id);
        $subLocation->delete();
        return response()->json('Removed successfully');
    }
}
