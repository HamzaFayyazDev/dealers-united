<?php

namespace App\Policies;

use App\Models\MessageCapsule;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessageCapsulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return Response::allow();
    }
    
    /**
     * Determine whether the user can view the messageCapsule.
     */
    public function view(User $user, MessageCapsule $messageCapsule)
    {
        return $this->canAccessMessageCapsule($user, $messageCapsule);
    }

    /**
     * Determine whether the user can open the messageCapsule.
     */
    public function open(User $user, MessageCapsule $messageCapsule)
    {
        return $this->canAccessMessageCapsule($user, $messageCapsule);
    }

    /**
     * Check if the user owns the messageCapsule.
     */
    private function ownsMessageCapsule(User $user, MessageCapsule $messageCapsule): bool
    {
        return $user->is($messageCapsule->user);
    }

    /**
     * Check if the user owns the messageCapsule and if the scheduled opening time has passed.
     */
    private function canAccessMessageCapsule(User $user, MessageCapsule $messageCapsule)
    {    
        if (!$this->ownsMessageCapsule($user, $messageCapsule)) {
            return Response::deny('You are not authorized to access this message capsule.');
        } else if (!$messageCapsule->openingTimePassed()) {
            return Response::deny('Message capsule cannot be opened - time remaining!.');
        }

        return Response::allow();
    }
}
