<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = ['id_disease', 'id_symptom', 'description','value'];

    /**
     * Get the symptom that owns the rule.
     */
    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
