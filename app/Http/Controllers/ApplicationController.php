<?php

namespace App\Http\Controllers;

use App\Models\ApplicantIdentifier;
use App\Models\Application;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $applications = $this->applications();

        return view('applications.index', compact('applications'), ['title' => 'Applications']);
    }

    // post method by api
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
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

            DB::commit();

            return response()->json(['message' => 'Application created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Application creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateApplication(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($id);
            $this->validateUpdateRequest($request);

            $application->application_date = $request->applicationDate;
            $application->village_id = $request->village;
            $application->collected_by = $request->nameOfOfficer;
            $application->collection_date = $request->dateCollected;
            $application->save();

            // we need to destroy all application social programmes and reattach them
            $application->socialProgrammes()->delete();
            $this->attachSocialProgrammes($application, $request->socialAssistanceProgramme);

            DB::commit();

            return response()->json(['message' => 'Application updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Application update failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function approveApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->approved = 1;
        $application->approved_by = Auth::user()->id;
        $application->approved_date = date('Y-m-d');
        $application->save();

        return response()->json(['message' => 'Application approved successfully'], 200);
    }


    private function validateUpdateRequest($request)
    {
        try {
            $request->validate([
                'applicationDate' => 'required|date',
                'village' => 'required|integer',
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
                // idNumber should only be alphanumeric
                'idNumber' => 'regex:/^[a-zA-Z0-9]+$/',
                'village' => 'required|integer',
                'postalAddress' => 'nullable|string|max:255',
                'physicalAddress' => 'nullable|string|max:255',
                // telephone is not required but should be a string and have a max length of 255
                'telephoneContacts' => 'nullable|string|max:255',
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

    private function applications()
    {
        $applications = DB::select("
            select app.id, app.application_date, app.collection_date, GROUP_CONCAT(DISTINCT(sp.name)) social_programmes,
                CONCAT_WS(' ', u.first_name, u.middle_name, u.last_name) as collected_by, d.name as designation,
                v.name village, sl.name sub_location, l.name location, sc.name sub_county, c.name county, GROUP_CONCAT(DISTINCT(CONCAT_WS('~', ai.identifier, it.name))) identifiers,
                CONCAT_WS(' ', ben.first_name, ben.middle_name, ben.last_name) applicant_name,
                GROUP_CONCAT(DISTINCT(at.telephone)) as telephone_contacts, TIMESTAMPDIFF(YEAR, ben.date_of_birth, now()) age, g.name gender, ms.name marital_status, ben.physical_address, ben.postal_address,
                CONCAT_WS(' ', approver.first_name, approver.middle_name, approver.last_name) as approved_by, app.approved_date, IF(app.approved = 1, 'Approved', 'Pending Approval') as approved, ad.name as approver_designation
            from applications app
            inner join applicants ben on ben.id = app.applicant_id
            inner join application_social_programmes asp on app.id = asp.application_id
            inner join social_programs sp on asp.social_programme_id = sp.id
            inner join users u on u.id = app.collected_by
            inner join genders g on ben.sex_id = g.id
            inner join marital_statuses ms on ms.id = ben.marital_status_id
            inner join designations d on u.designation_id = d.id
            inner join villages v on v.id = app.village_id
            inner join sub_locations sl on sl.id = v.sub_location_id
            inner join locations l on sl.location_id = l.id
            inner join sub_counties sc on l.sub_county_id = sc.id
            inner join counties c on sc.county_id = c.id
            left join users approver on approver.id = app.approved_by
            left join designations ad on approver.designation_id = ad.id
            left join applicant_identifiers ai on ben.id = ai.applicant_id
            left join identifier_types it on ai.identifier_type_id = it.id
            left join applicant_telephones at on at.applicant_id = ai.applicant_id
            GROUP BY app.id
        ");
        return $applications;
    }
}
