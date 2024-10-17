<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'unblocked_at' => 'datetime',
            'consecutive_login_end_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user_data(): HasOne{
        return $this->hasOne(UserData::class);
    }
    public function old_password(): HasMany{
        return $this->hasMany(OldPassword::class);
    }
    public function sentChat(): HasManyThrough{
        return $this->hasManyThrough(Chat::class,UserChatUser::class, 'from_id','id','id','chat_id');
    }
    public function receivedChat(): HasManyThrough{
        return $this->hasManyThrough(Chat::class,UserChatUser::class, 'to_id','id','id','chat_id');
    }
    public function chatUsers(): HasManyThrough{
        return $this->hasManyThrough(User::class,UserChatUser::class, 'from_id','id','id','to_id');
    }
}
