<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OldPassword extends Model
{
    use HasFactory;
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
