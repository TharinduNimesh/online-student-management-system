<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherSubject>
 */
class TeacherSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher = Teacher::all()->random();
        $subject = Subject::all()->random();

        if ($teacher->subjects()->where('subject_id', $subject->id)->first()) {
            return $this->definition();
        }

        return [
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
        ];
    }
}
