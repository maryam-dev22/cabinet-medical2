<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'patient')->get();
        $services = Service::all();

        // Create 20 appointments
        for ($i = 0; $i < 20; $i++) {
            Appointment::create([
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'appointment_date' => now()->addDays(rand(1, 30))->addHours(rand(9, 17)),
                'status' => ['pending', 'confirmed', 'cancelled'][rand(0, 2)],
                'notes' => rand(0, 1) ? 'Patient requested additional information.' : null,
            ]);
        }
    }
}
