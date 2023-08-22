<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherGrade>
 */
class TeacherGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher = Teacher::all()->random();
        $grade = $this->faker->numberBetween(1, 13);

        if ($teacher->grades()->where('grade', $grade)->first()) {
            return $this->definition();
        }

        return [
            'teacher_id' => $teacher->id,
            'grade' => $grade,            
        ];
    }
}
