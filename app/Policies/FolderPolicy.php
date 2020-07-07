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
    * @param Folder $folder
    * @return bool
    */
    public function view(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}
