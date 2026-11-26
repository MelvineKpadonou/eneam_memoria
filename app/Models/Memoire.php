<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Memoire extends Model
{
    protected $fillable = [
        'titre',
        'resume',
        'fichier_path',
        'statut',
        'motif_rejet',
        'acces_restreint',
        'telechargement_autorise',
        'date_embargo',
        'auteur_id',
        'encadreur_id',
        'filiere_id',
        'annee_academique_id',
    ];

    protected $casts = [
        'acces_restreint' => 'boolean',
        'telechargement_autorise' => 'boolean',
        'date_embargo' => 'date',
    ];

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function encadreur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'encadreur_id');
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

    public function motCles()
    {
        return $this->belongsToMany(MotCle::class, 'memoire_mot_cle', 'memoire_id', 'mot_cle_id');
    }
}
