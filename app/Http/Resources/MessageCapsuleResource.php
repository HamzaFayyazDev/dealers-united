<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageCapsuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'note' => $this->is_opened ? $this->note : substr($this->note, 0, 4).'****',
            'scheduled_opening_time' => $this->scheduled_opening_time,
            'is_opened' => boolval($this->is_opened),
        ];
    }
}
