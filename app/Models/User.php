<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Collection;

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
    public function sentChatUser(): HasMany{
        return $this->HasMany(UserChatUser::class, 'from_id','id');
    }
    public function receivedChatUser(): HasMany{
        return $this->HasMany(UserChatUser::class, 'to_id','id');
    }
    public function chatUsers(): Collection{
        // Users where the current user is the sender (from_id) and the others are receivers (to_id)
        $usersFrom = User::whereHas('receivedChat', function($query) {
            $query->where('from_id', $this->id);
        })->distinct()->withCount(['sentChatUser as unread_count' => function ($query) {
            $query->where('to_id',$this->id)->where('is_read',false);
        }])->get();

        // Users where the current user is the receiver (to_id) and the others are senders (from_id)
        $usersTo = User::whereHas('sentChat', function($query) {
            $query->where('to_id', $this->id);
        })->distinct()->withCount(['sentChatUser as unread_count' => function ($query) {
            $query->where('to_id',$this->id)->where('is_read',false);
        }])->get();

        // Merge both collections and remove duplicates
        return $usersFrom->merge($usersTo)->unique('id');
    }
}
