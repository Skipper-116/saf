<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\County;
use App\Models\Location;
use App\Models\SubCounty;
use App\Models\SubLocation;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $applications = Application::all()->count();
        $applicants = Applicant::all()->count();
        $counties = County::all()->count();
        $sub_counties = SubCounty::all()->count();
        $locations = Location::all()->count();
        $sub_locations = SubLocation::all()->count();
        $villages = SubLocation::all()->count();
        $users = User::all()->count();
        // lets create a list of hash/objects to pass to the view
        $stats = [
            ['name' => 'Applications', 'count' => $applications, 'route' => 'applications'],
            ['name' => 'Applicants', 'count' => $applicants, 'route' => 'applicants'],
            ['name' => 'Counties', 'count' => $counties, 'route' => 'counties'],
            ['name' => 'Sub Counties', 'count' => $sub_counties, 'route' => 'sub_counties'],
            ['name' => 'Locations', 'count' => $locations, 'route' => 'locations'],
            ['name' => 'Sub Locations', 'count' => $sub_locations, 'route' => 'sub_locations'],
            ['name' => 'Villages', 'count' => $villages, 'route' => 'villages'],
            ['name' => 'Users', 'count' => $users, 'route' => 'users'],
        ];
        return view('home', ['title' => 'Home', 'stats' => $stats]);
    }
}
