<?php

namespace App\Policies;

use App\Todo;
use App\User;

class FolderPolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(User $user, Folder $folder)
    {
        return $user->folder === $folder->user_id;
    }
}
