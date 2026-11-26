<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['nom', 'prenom', 'matricule', 'email', 'password', 'role', 'role_verifie', 'filiere_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_verifie' => 'boolean',
    ];

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function memoires(): HasMany
    {
        return $this->hasMany(Memoire::class, 'auteur_id');
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'conseiller_id');
    }

    public function favoris(): HasMany
    {
        return $this->hasMany(Favori::class);
    }
}
