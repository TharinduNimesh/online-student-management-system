<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher = User::where('role_id', 4)->get()->random();
        $validate = Teacher::where('email', $teacher->email)->first();

        if ($validate) {
            return $this->definition();
        }

        return [
            'name' => $teacher->name,
            'email' => $teacher->email,
            'mobile' => '077' . $this->faker->numberBetween(1000000, 9999999),
            'verified_at' => $this->faker->randomElement([now()->toDate(), null]),
            'city_id' => $this->faker->numberBetween(1, 49),
            'gender_id' => $this->faker->randomElement([1, 2]),
        ];
    }
}
