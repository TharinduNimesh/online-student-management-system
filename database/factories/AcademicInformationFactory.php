<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicInformation>
 */
class AcademicInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student = Student::all()->random();
        $grade = $student->grades()->where('year', date("Y"))->first();

        if ($grade) {
            return $this->definition();
        }

        return [
            'student_id' => $student->id,
            'year' => date("Y"),
            'grade' => $this->faker->numberBetween(1, 13),
            'has_paid' => $this->faker->randomElement([0, 1]),
        ];
    }
}
