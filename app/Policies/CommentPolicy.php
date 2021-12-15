<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;

    public function ownsComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user->id
        ? Response::allow()
        : Response::deny('Access denied.');
    }
}
