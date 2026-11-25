<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filiere extends Model
{
    protected $fillable = ['nom', 'code'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function memoires(): HasMany
    {
        return $this->hasMany(Memoire::class);
    }
}
