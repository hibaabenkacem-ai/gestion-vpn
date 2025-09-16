<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demande_vpns', function (Blueprint $table) {
            $table->id(); // idDemande
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // user_id
            $table->foreignId('groupe_vpn_id')->constrained('groupe_vpns')->cascadeOnDelete();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->text('justification');
            $table->string('statut')->default('soumis'); // soumis, valide, refuse, annule
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demande_vpns');
    }
};
