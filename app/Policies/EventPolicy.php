<?php

namespace App\Policies;

use App\Event;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class EventPolicy
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

//    /**
//     * @param User $user
//     * @param Request $request
//     * @return boolean
//     */
//    public function create(User $user, Request $request){
//        $association = $request->get('asso_id');
//        return $user->associations->find($association) != null;
//    }

    /**
     * @param User $user
     * @param Event $event
     * @return boolean
     */
    public function update(User $user, Event $event){
        $association = $event->association;
        return $user->associations->find($association) != null;
    }

    /**
     * @param User $user
     * @param Event $event
     * @return boolean
     */
    public function delete(User $user, Event $event){
        $association = $event->association;
        return $user->associations->find($association) != null;
    }
}
