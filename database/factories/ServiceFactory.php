<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = [
            'General Consultation',
            'Dental Checkup',
            'Eye Examination',
            'Blood Test',
            'X-Ray',
            'Physical Therapy',
            'Vaccination',
            'Cardiology Checkup',
            'Dermatology Consultation',
            'Pediatric Checkup',
            'Orthopedic Consultation',
            'Neurology Examination',
        ];
        
        return [
            'name' => fake()->randomElement($services),
            'description' => fake()->sentence(10),
            'price' => fake()->randomFloat(2, 50, 500),
        ];
    }
}
