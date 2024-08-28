<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\Location;
use App\Models\SubLocation;
use App\Models\County;
use App\Models\Gender;
use App\Models\IdentifierType;
use App\Models\MaritalStatus;
use App\Models\SocialProgram;
use App\Models\SubCounty;
use App\Models\User;
use App\Models\Village;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     */
    public function run(): void
    {
        $designations = [
            'System Administrator',
            'Manager',
            'Supervisor',
            'Officer',
            'Clerk',
        ];

        foreach ($designations as $designation) {
            Designation::factory()->create([
                'name' => $designation,
            ]);
        }

        // User::factory(10)->create();
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'middle_name' => 'Middle',
            'designation_id' => Designation::where('name', 'System Administrator')->first()->id,
            'email' => 'test@example.com',
        ]);

        // Location Metadata
        County::factory(10)->create();
        SubCounty::factory(20)->create();
        Location::factory(40)->create();
        SubLocation::factory(80)->create();
        Village::factory(160)->create();

        foreach(['Female', 'Male'] as $gender){
            Gender::factory()->create([
                'name' => $gender,
            ]);
        }

        $maritals = [
            'Single',
            'Married',
            'Divorced',
            'Widowed',
            'Separated',
        ];

        foreach ($maritals as $marital) {
            MaritalStatus::factory()->create([
                'name' => $marital,
            ]);
        }

        foreach(['Passport Number', 'Identity Card'] as $id_type){
            IdentifierType::factory()->create([
                'name' => $id_type,
            ]);
        }

        $programs = [
            'Orphans and vulnerable children',
            'Poor elderly persons',
            'Persons with disability',
            'Persons in extreme poverty',
            'Any other',
        ];

        foreach ($programs as $program) {
            SocialProgram::factory()->create([
                'name' => $program,
            ]);
        }
    }
}
