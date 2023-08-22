<?php

namespace Database\Factories;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officer>
 */
class OfficerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $officer = User::where('role_id', 3)->get()->random();
        
        $validate = Officer::where('email', $officer->email)
        ->first();

        if ($validate) {
            return $this->definition();
        }

        return [
            'name' => $officer->name,
            'email' => $officer->email,
            'mobile' => '077' . $this->faker->unique()->randomNumber(7),
            'verified_at' => $this->faker->randomElement([now(), null]),
            'city_id' => $this->faker->numberBetween(1, 49),
            'gender_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
