<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->nullable();
            $table->string('service')->nullable();
            $table->string('fonction')->nullable();
            $table->string('role')->default('employe'); // roles: employe, manager, controle_interne, it, admin
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'service', 'fonction', 'role']);
        });
    }
};
