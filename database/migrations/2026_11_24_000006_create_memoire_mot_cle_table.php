<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Table de liaison de l'association plusieurs-à-plusieurs Memoire <-> MotCle
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memoire_mot_cle', function (Blueprint $table) {
            $table->foreignId('memoire_id')->constrained('memoires')->cascadeOnDelete();
            $table->foreignId('mot_cle_id')->constrained('mot_cles')->cascadeOnDelete();
            $table->primary(['memoire_id', 'mot_cle_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memoire_mot_cle');
    }
};
