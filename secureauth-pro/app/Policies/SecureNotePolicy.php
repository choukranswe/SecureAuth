<?php

namespace App\Policies;

use App\Models\SecureNote;
use App\Models\User;

class SecureNotePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SecureNote $secureNote): bool
    {
        return $user->id === $secureNote->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SecureNote $secureNote): bool
    {
        return $user->id === $secureNote->user_id;
    }

    public function delete(User $user, SecureNote $secureNote): bool
    {
        return $user->id === $secureNote->user_id;
    }
}
