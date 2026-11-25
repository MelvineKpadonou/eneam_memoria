<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('validation_memoires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memoire_id')->nullable()->constrained('memoire')->onDelete('set null');
            $table->foreignId('validateur_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('decision', 500);
            $table->string('motif', 500);
            $table->date('date_decision');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validation_memoires');
    }
};
