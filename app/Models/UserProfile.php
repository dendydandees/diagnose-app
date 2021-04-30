<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'age'
    ];

    /**
     * Get the user that owns the user profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
