<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    protected $fillable = ['memoire_id', 'conseiller_id', 'note', 'commentaire', 'date_consultation'];

    public function memoire(): BelongsTo
    {
        return $this->belongsTo(Memoire::class);
    }

    public function conseiller(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'conseiller_id');
    }
}
