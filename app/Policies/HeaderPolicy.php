<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Header;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeaderPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any app models headers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the app models header.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Header  $header
     * @return mixed
     */
    public function view(User $user, Header $header)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create app models headers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the app models header.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Header  $header
     * @return mixed
     */
    public function update(User $user, Header $header)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the app models header.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Header  $header
     * @return mixed
     */
    public function delete(User $user, Header $header)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the app models header.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Header  $header
     * @return mixed
     */
    public function restore(User $user, Header $header)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the app models header.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Header  $header
     * @return mixed
     */
    public function forceDelete(User $user, Header $header)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }
}
