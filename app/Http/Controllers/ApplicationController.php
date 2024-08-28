<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 0);
        $size = $request->input('size', 10);
        $count = Application::count();
        $applications = Application::skip($page * $size)->take($size)->get();

        return view('applications.index', compact('applications', 'count'), ['title' => 'Applications']);
    }

    public function create()
    {
        return view('applications.create', ['title' => 'Create Application']);
    }

    public function show($id)
    {
        $application = Application::findOrFail($id);

        return view('applications.show', compact('application'), ['title' => 'Application Details']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $application = Application::create($request->only('name', 'description'));

        return redirect()->route('applications.index');
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);

        return view('applications.edit', compact('application'), ['title' => 'Edit Application']);
    }
}