<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder() -> first();
        return [
            'title' => $this -> faker -> sentence(rand(3, 5)),
            'content' => $this -> faker -> paragraph(rand(1, 3)),
            'user_id' => $user -> id
        ];
    }
}
