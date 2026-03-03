<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'is_share',
    ];

    protected $casts = [
        'is_share' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($note) {
            if (! $note->user_id) {
                $note->user_id = auth()->id();
            }
        });
    }
}
