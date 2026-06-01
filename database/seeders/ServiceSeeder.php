<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'General Consultation',
                'description' => 'Comprehensive health checkup and consultation with a general practitioner.',
                'price' => 75.00,
            ],
            [
                'name' => 'Dental Checkup',
                'description' => 'Complete dental examination including teeth cleaning and oral health assessment.',
                'price' => 120.00,
            ],
            [
                'name' => 'Eye Examination',
                'description' => 'Vision test and eye health examination by an optometrist.',
                'price' => 95.00,
            ],
            [
                'name' => 'Blood Test',
                'description' => 'Complete blood count and basic metabolic panel.',
                'price' => 85.00,
            ],
            [
                'name' => 'X-Ray',
                'description' => 'Diagnostic X-ray imaging for bone and tissue examination.',
                'price' => 150.00,
            ],
            [
                'name' => 'Physical Therapy',
                'description' => 'Therapeutic exercises and rehabilitation session.',
                'price' => 110.00,
            ],
            [
                'name' => 'Vaccination',
                'description' => 'Administration of recommended vaccines.',
                'price' => 65.00,
            ],
            [
                'name' => 'Cardiology Checkup',
                'description' => 'Heart health examination including EKG and consultation.',
                'price' => 200.00,
            ],
            [
                'name' => 'Dermatology Consultation',
                'description' => 'Skin examination and treatment consultation.',
                'price' => 130.00,
            ],
            [
                'name' => 'Pediatric Checkup',
                'description' => 'Comprehensive health examination for children.',
                'price' => 90.00,
            ],
            [
                'name' => 'Orthopedic Consultation',
                'description' => 'Bone and joint examination and treatment planning.',
                'price' => 175.00,
            ],
            [
                'name' => 'Neurology Examination',
                'description' => 'Nervous system assessment and neurological consultation.',
                'price' => 250.00,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
