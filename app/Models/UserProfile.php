<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the user profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
