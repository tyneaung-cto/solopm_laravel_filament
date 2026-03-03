<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, Note $note): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create(User $user): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user, Note $note): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
    // public function delete(User $user, Note $note): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Note $note): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Note $note): bool
    // {
    //     return false;
    // }
    public function view(User $user, Note $note): bool
    {
        // Owner can always view
        if ($note->user_id === $user->id) {
            return true;
        }

        // Others can view only if shared
        return $note->is_share === true;
    }

    public function update(User $user, Note $note): bool
    {
        // Only owner can edit
        return $note->user_id === $user->id;
    }

    public function delete(User $user, Note $note): bool
    {
        // Only owner can delete
        return $note->user_id === $user->id;
    }

    public function viewAny(User $user): bool
    {
        return true; // allow listing
    }

    public function create(User $user): bool
    {
        return true;
    }
}
