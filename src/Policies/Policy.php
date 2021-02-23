<?php

namespace Armincms\Location\Policies;
 
use Illuminate\Contracts\Auth\Authenticatable as User;
use Illuminate\Auth\Access\HandlesAuthorization; 

class Policy
{
    use HandlesAuthorization; 
    
    /**
     * Determine whether the user can view the location.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Armincms\Location\Location  $location
     * @return mixed
     */
    public function view(User $user, $location)
    {
        return true;
    }

    /**
     * Determine whether the user can create locations.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the location.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Armincms\Location\Location  $location
     * @return mixed
     */
    public function update(User $user, $location)
    { 
        return true;
    }

    /**
     * Determine whether the user can delete the location.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Armincms\Location\Location  $location
     * @return mixed
     */
    public function delete(User $user, $location)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the location.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Armincms\Location\Location  $location
     * @return mixed
     */
    public function restore(User $user, $location)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the location.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Armincms\Location\Location  $location
     * @return mixed
     */
    public function forceDelete(User $user, $location)
    {
        return true;
    }
}
