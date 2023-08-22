<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student = User::where('role_id', 5)->get()->random();
        $validate = Student::where('email', $student->email)->first();

        if ($validate) {
            return $this->definition();
        }

        return [
            'name' => $student->name,
            'email' => $student->email,
            'mobile' => '077' . $this->faker->numberBetween(1000000, 9999999),
            'date_of_birth' => $this->faker->date(),
            'verified_at' => $this->faker->randomElement([now()->toDate(), null]),
            'city_id' => $this->faker->numberBetween(1, 49),
            'gender_id' => $this->faker->randomElement([1, 2]),
        ];
    }
}
