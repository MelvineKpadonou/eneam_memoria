<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('validation_memoires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memoire_id')->constrained('memoires')->cascadeOnDelete();
            $table->foreignId('validateur_id')->constrained('users')->restrictOnDelete();
            $table->string('decision'); // valide ou rejete
            $table->text('motif')->nullable();
            $table->timestamp('date_decision')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('validation_memoires');
    }
};
