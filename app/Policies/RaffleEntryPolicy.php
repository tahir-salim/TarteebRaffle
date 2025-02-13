<?php

namespace App\Policies;

use App\Models\RaffleEntry;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaffleEntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaffleEntry  $raffleEntry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RaffleEntry $raffleEntry)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaffleEntry  $raffleEntry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RaffleEntry $raffleEntry)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaffleEntry  $raffleEntry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RaffleEntry $raffleEntry)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaffleEntry  $raffleEntry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RaffleEntry $raffleEntry)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaffleEntry  $raffleEntry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RaffleEntry $RaffleEntry)
    {
        return $user->isAdmin();
    }

    public function attachAnyReceipt(User $user, RaffleEntry $RaffleEntry)
    {
        return false;
    }
}
