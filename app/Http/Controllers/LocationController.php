<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getLocations()
    {
        $locations = Location::all();
        return response()->json($locations);
    }

    public function getLocation($id)
    {
        $location = Location::find($id);
        return response()->json($location);
    }

    public function getLocationsBySubCounty($sub_county_id)
    {
        $locations = Location::where('sub_county_id', $sub_county_id)->get();
        return response()->json($locations);
    }

    public function create(Request $request)
    {
        $location = new Location();
        $location->name = $request->name;
        $location->sub_county_id = $request->sub_county_id;
        $location->save();
        return response()->json($location);
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->name = $request->name;
        $location->sub_county_id = $request->sub_county_id;
        $location->save();
        return response()->json($location);
    }

    public function delete($id)
    {
        $location = Location::find($id);
        $location->delete();
        return response()->json('Removed successfully');
    }

}
