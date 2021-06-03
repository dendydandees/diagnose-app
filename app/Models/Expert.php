<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'position', 'company'
    ];

    /**
     * Get the user that owns the expert.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
