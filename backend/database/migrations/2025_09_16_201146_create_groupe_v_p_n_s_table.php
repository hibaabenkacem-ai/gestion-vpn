<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groupe_vpns', function (Blueprint $table) {
            $table->id(); // idGroupe
            $table->string('nom_groupe');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // pivot table user <-> groupe
        Schema::create('groupe_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groupe_vpn_id')->constrained('groupe_vpns')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groupe_user');
        Schema::dropIfExists('groupe_vpns');
    }
};
