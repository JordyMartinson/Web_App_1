<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Arr;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder() -> first();
        $post = Post::inRandomOrder()->first();
        return [
            'content' => $this -> faker -> sentence(rand(3, 5)),
            'user_id' => $user -> id,
            'post_id' => $post -> id
        ];
    }
}
