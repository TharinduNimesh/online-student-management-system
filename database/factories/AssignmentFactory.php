<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher = Teacher::all()->random();

        if ($teacher->grades()->count() === 0) {
            return $this->definition();
        } else if ($teacher->subjects()->count() === 0) {
            return $this->definition();
        }

        $start = $this->faker->dateTimeBetween('-2 week', now());
        
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->sentence(20),
            'grade' => $teacher->grades()->get()->random()->grade,
            'subject_id' => $teacher->subjects()->get()->random()->id,
            'started_at' => $start,
            'ended_at' => now()->addDays($this->faker->numberBetween(1, 7)),
            'file_name' => '64e2554c193b7.pdf',
            'uploaded_by' => $teacher->id,
        ];
    }
}
