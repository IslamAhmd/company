<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Slider;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any sliders.
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
     * Determine whether the user can view the slider.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function view(User $user, Slider $slider)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create sliders.
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
     * Determine whether the user can update the slider.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function update(User $user, Slider $slider)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the slider.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function delete(User $user, Slider $slider)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the slider.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function restore(User $user, Slider $slider)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the slider.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function forceDelete(User $user, Slider $slider)
    {
        if ($user->isAdmin() || $user->isSupervisor()){
            return true;
        }
        return false;
    }
}
