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
        Schema::create('horaire', function (Blueprint $table) {
            $table->id();
            $table->string('jour');
            $table->time('heure_ouverture');
            $table->time('heure_fermeture');
            $table->string('status');
            $table->foreignId('restaurantId')->constrained('restaurant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaire');
    }
};
