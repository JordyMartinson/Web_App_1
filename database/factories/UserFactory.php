<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this -> faker -> name(),
            'email' => $this -> faker -> unique() -> email(),
            'password' => $this -> faker -> numerify('##########'),
            'remember_token' => $this -> faker ->  lexify('?????')
        ];
    }
}
