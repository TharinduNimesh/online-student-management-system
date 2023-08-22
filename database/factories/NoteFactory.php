<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
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

        return [
            'title' => $this->faker->sentence(5),
            'file' => '64e26564b7831.docx',
            'grade' => $teacher->grades()->get()->random()->grade,
            'subject_id' => $teacher->subjects()->get()->random()->id,
            'uploaded_at' => now(),
            'uploaded_by' => $teacher->id,
        ];
    }
}
