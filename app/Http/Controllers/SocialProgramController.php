<?php

namespace App\Http\Controllers;

use App\Models\SocialProgram;
use Illuminate\Http\Request;

class SocialProgramController extends Controller
{
    public function getSocialPrograms()
    {
        $socialPrograms = SocialProgram::all();
        return response()->json($socialPrograms);
    }
}
