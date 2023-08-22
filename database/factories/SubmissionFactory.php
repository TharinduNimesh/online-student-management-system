<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $assignment = \App\Models\Assignment::all()->random();
        $student = \App\Models\Student::all()->random();

        if($student->submissions()->where('assignment_id', $assignment->id)->count() > 0) {
            return $this->definition();
        }

        return [
            'file' => $this->faker->randomElement(['64e318267bbbd.pdf', '64e31852523bf.pdf']),
            'submitted_at' => now()->addDays($this->faker->numberBetween(1, 6)),
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
        ];
    }
}
