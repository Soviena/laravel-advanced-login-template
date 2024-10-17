<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    public function chatUsers(): BelongsTo{
        return $this->belongsTo(UserChatUser::class);
    }
}
