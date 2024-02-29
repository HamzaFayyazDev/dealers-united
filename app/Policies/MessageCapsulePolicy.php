<?php

namespace App\Policies;

use App\Models\MessageCapsule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessageCapsulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MessageCapsule $messageCapsule): bool
    {
        return $this->ownsMessageCapsule($user, $messageCapsule);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MessageCapsule $messageCapsule): bool
    {
        return $this->canAccessMessageCapsule($user, $messageCapsule);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MessageCapsule $messageCapsule): bool
    {
        return $this->canAccessMessageCapsule($user, $messageCapsule);
    }

    /**
     * Check if the user owns the message capsule.
     */
    private function ownsMessageCapsule(User $user, MessageCapsule $messageCapsule): bool
    {
        return $user->id === $messageCapsule->user_id;
    }

    /**
     * Check if the user owns the message capsule and if the scheduled opening time has passed.
     */
    private function canAccessMessageCapsule(User $user, MessageCapsule $messageCapsule): bool
    {   
        return $this->ownsMessageCapsule($user, $messageCapsule) && Carbon::now()->gte(Carbon::parse($messageCapsule->scheduled_opening_time)) ?
            Response::allow() : Response::deny('You do not own this message capsule.');
    }
}
