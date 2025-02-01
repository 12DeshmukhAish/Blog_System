<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
// app/Policies/CommentPolicy.php

    public function delete(User $user, Comment $comment)
    {
        return $user->isAdmin() || $user->id === $comment->user_id;
    }
}
