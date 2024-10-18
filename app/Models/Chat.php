<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chat extends Model
{
    public $timestamps = false;
    public function chatUsers(): HasOne{
        return $this->HasOne(UserChatUser::class,'chat_id','id');
    }
}
