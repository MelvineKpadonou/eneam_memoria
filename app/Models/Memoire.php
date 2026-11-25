<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Memoire extends Model
{
    protected $fillable = ['titre', 'resume', 'contenu', 'filiere_id', 'annee_academique_id', 'etudiant_id'];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'etudiant_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function anneeAcademique(): BelongsTo
    {
        return $this->belongsTo(AnneeAcademique::class);
    }

    public function validationMemoire(): HasMany
    {
        return $this->hasMany(ValidationMemoire::class);
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}
