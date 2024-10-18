<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserChatUser extends Model
{
    public function from_user(): HasOne{
        return $this->hasOne(User::class, 'id','from_id');
    }
    public function to_user(): HasOne{
        return $this->hasOne(User::class, 'id','to_id');
    }
    public function chat(): BelongsTo{
        return $this->BelongsTo(Chat::class,'chat_id');
    }
}
