<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Links;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sections.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Links  $sections
     * @return mixed
     */
    public function view(User $user, Links $links)
    {
      return $user->checkRead($links);
    }

    /**
     * Determine whether the user can create sections.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      return $user->checkCreate(new Links);
    }

    /**
     * Determine whether the user can update the sections.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Links  $sections
     * @return mixed
     */
    public function update(User $user, Links $links)
    {
      return $user->checkUpdate($links);
    }

    /**
     * Determine whether the user can delete the sections.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Links  $sections
     * @return mixed
     */
    public function delete(User $user, Links $links)
    {
      return $user->checkDelete($links);
    }
}
