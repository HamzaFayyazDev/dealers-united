<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageCapsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'scheduled_opening_time',
        'is_opened',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
     * Fetch all unopened message capsules.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllUnopened()
    {
        return self::where('is_opened', false)->get();
    }
}
