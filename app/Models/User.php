<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['nom', 'prenom', 'matricule', 'email', 'role', 'filiere_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function memoires(): HasMany
    {
        return $this->hasMany(Memoire::class, 'etudiant_id');
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'conseiller_id');
    }
}
