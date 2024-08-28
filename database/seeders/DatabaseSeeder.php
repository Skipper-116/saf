<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Designation;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Designation::factory(10)->create();
        // we need to create the following designations: System Administrator, Manager, Supervisor, Officer, Clerk
        Designation::factory()->create([
            'name' => 'System Administrator',
        ]);
        Designation::factory()->create([
            'name' => 'Manager',
        ]);
        Designation::factory()->create([
            'name' => 'Supervisor',
        ]);
        Designation::factory()->create([
            'name' => 'Officer',
        ]);
        Designation::factory()->create([
            'name' => 'Clerk',
        ]);

        // User::factory(10)->create();
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'middle_name' => 'Middle',
            'designation_id' => Designation::where('name', 'System Administrator')->first()->id,
            'email' => 'test@example.com',
        ]);


    }
}
