<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index', ['title' => 'Users']);
    }

    public function getUsers()
    {
        // raw SQL query with a join with the designation table
        $users = User::select(
                'users.id',
                DB::raw("CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name) as name"),
                'designations.name as designation'
            )
            ->join('designations', 'users.designation_id', '=', 'designations.id')
            ->get();
        return response()->json($users);
    }
}
