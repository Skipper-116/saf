<?php

namespace App\Http\Controllers;

use App\Models\ApplicantIdentifier;
use App\Models\Application;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    // post method by api
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $identifier = $this->findIdentifier($request->idNumber, $request->idType);

        if ($identifier) {
            $application = $this->createApplication($request, $identifier->applicant_id);
            $this->attachSocialProgrammes($application, $request->socialAssistanceProgramme);
        } else {
            $applicant = $this->createApplicant($request);
            $this->createApplicantPhoneNumbers($applicant, $request->telephoneContacts);
            $this->createApplicantIdentifier($applicant, $request->idNumber, $request->idType);
            $application = $this->createApplication($request, $applicant->id);
            $this->attachSocialProgrammes($application, $request->socialAssistanceProgramme);
        }

        return response()->json(['message' => 'Application created successfully'], 201);
    }

    private function validateRequest($request)
    {
        try {
            $request->validate([
                'applicationDate' => 'required|date',
                'fullName' => 'required|string|max:255',
                'sex' => 'required|in:1,2',
                'age' => 'required|integer|min:0',
                'maritalStatus' => 'required|in:1,2,3,4',
                'idType' => 'required|integer',
                'idNumber' => 'required|string|max:255',
                'village' => 'required|integer',
                'postalAddress' => 'required|string|max:255',
                'physicalAddress' => 'required|string|max:255',
                'telephoneContacts' => 'required|string|max:15',
                'socialAssistanceProgramme' => 'required|array',
                'socialAssistanceProgramme.*' => 'integer',
                'nameOfOfficer' => 'required|string|max:255',
                'dateCollected' => 'required|date',
                '_token' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->errors());
            throw $e;
        }
    }

    private function findIdentifier($idNumber, $idType)
    {
        return ApplicantIdentifier::where('identifier', $idNumber)
            ->where('identifier_type_id', $idType)
            ->first();
    }

    private function createApplication($request, $applicant_id)
    {
        return Application::create([
            'applicant_id' => $applicant_id,
            'village_id' => $request->village,
            'application_date' => $request->applicationDate,
            'collected_by' => $request->nameOfOfficer,
            'collection_date' => $request->dateCollected,
            'creator' => Auth::user()->id,
        ]);
    }

    private function attachSocialProgrammes($application, $socialProgrammes)
    {
        foreach ($socialProgrammes as $programme) {
            $application->socialProgrammes()->create([
                'social_programme_id' => $programme,
                'creator' => Auth::user()->id,
            ]);
        }
    }

    private function createApplicant($request)
    {
        $fullNameSplit = explode(' ', $request->fullName);
        $first_name = $fullNameSplit[0];
        $middle_name = implode(' ', array_slice($fullNameSplit, 1, count($fullNameSplit) - 2));
        $last_name = end($fullNameSplit);
        $year = date('Y') - (int)$request->age;
        // month and day should be set on the middle of the year
        $date_of_birth = date($year . '-06-15');

        return Applicant::create([
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'sex_id' => $request->sex,
            'date_of_birth' => $date_of_birth,
            'marital_status_id' => $request->maritalStatus,
            'postal_address' => $request->postalAddress,
            'physical_address' => $request->physicalAddress,
            'creator' => Auth::user()->id,
        ]);
    }

    private function createApplicantPhoneNumbers($applicant, $contacts)
    {
        $phoneNumbers = explode(',', $contacts);
        foreach ($phoneNumbers as $number) {
            $applicant->telephones()->create([
                'telephone' => $number,
                'creator' => Auth::user()->id,
            ]);
        }
    }

    private function createApplicantIdentifier($applicant, $idNumber, $idType)
    {
        $applicant->identifiers()->create([
            'identifier' => $idNumber,
            'identifier_type_id' => $idType,
            'creator' => Auth::user()->id,
        ]);
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);

        return view('applications.edit', compact('application'), ['title' => 'Edit Application']);
    }
}
