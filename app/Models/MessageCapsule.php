<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class MessageCapsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
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

    public function canBeOpened(): bool
    {
        return empty($this->is_opened) && $this->openingTimePassed();
    }

    public function openingTimePassed(): bool
    {
        return Carbon::now()->gte(Carbon::parse($this->scheduled_opening_time));
    }
}
