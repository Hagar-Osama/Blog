<?php

namespace App\Policies;

use App\Models\Artical;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticalPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
{
    if ($user->hasRole('superAdmin')) {
        return true;
    }
}

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->roles->hasPermission('view_artical');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->roles->hasPermission('create_artical');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Artical $artical)
    {
        return $user->roles->hasPermission('edit_artical');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Artical $artical)
    {
        return $user->roles->hasPermission('delete_artical');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Artical $artical)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Artical $artical)
    {
        //
    }

    public function showTable(User $user)
    {
        return $user->roles->hasPermission('view_artical');
    }
}
