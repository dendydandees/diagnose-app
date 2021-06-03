<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationHistory extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'answer', 'result', 'user_id'];
    protected $casts = [
        'answer' => AsCollection::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
