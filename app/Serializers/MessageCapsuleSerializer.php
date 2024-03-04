<?php

namespace App\Serializers;

use Tobscure\JsonApi\AbstractSerializer;

class MessageCapsuleSerializer extends AbstractSerializer
{
    protected $type = 'message-capsules';

    public function attributes($messageCapsule)
    {
        return [
            'id' => $messageCapsule->id,
            'note' => $messageCapsule->is_opened ? $messageCapsule->note : '****',
            'scheduled_opening_time' => $messageCapsule->scheduled_opening_time,
        ];
    }
}
