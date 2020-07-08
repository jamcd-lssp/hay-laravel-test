<?php

namespace App\Policies;

use App\Todo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
    * Create a new policy instance.
    * @param User $user
    * @param Todo $todo
    * @return bool
    */
    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
