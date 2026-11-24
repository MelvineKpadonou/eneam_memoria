<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Association plusieurs-à-plusieurs User <-> Memoire (clé primaire composée, comme dans le diagramme)
return new class extends Migration {
    public function up(): void
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('memoire_id')->constrained('memoires')->cascadeOnDelete();
            $table->primary(['user_id', 'memoire_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoris');
    }
};
