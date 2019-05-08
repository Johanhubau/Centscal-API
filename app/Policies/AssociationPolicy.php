<?php

namespace App\Policies;

use App\Association;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssociationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
 * @param User $user
 * @param Association $event
 * @return boolean
 */
    public function update(User $user, Association $association){
        return $user->is_admin or $user->associations->find($association) != null;
    }

    /**
     * @param User $user
     * @param Association $event
     * @return boolean
     */
    public function delete(User $user, Association $association){
        return $user->is_admin or $user->associations->find($association) != null;
    }
}
