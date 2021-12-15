<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function ownsPost(User $user, Post $post)
    {
        return $user->id === $post->user->id
        ? Response::allow()
        : Response::deny('Access denied.');
    }
}
