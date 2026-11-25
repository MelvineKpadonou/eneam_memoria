<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('memoire_id')->constrained('memoires')->cascadeOnDelete();
            $table->timestamp('date_lecture')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
