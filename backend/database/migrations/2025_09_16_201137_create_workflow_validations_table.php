<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workflow_validations', function (Blueprint $table) {
            $table->id(); // idWorkflow
            $table->foreignId('demande_vpn_id')->constrained('demande_vpns')->cascadeOnDelete(); // idDemande
            $table->string('etape_actuelle'); // ex: manager, controle_interne, responsable_it
            $table->string('statut')->default('en_attente'); // en_attente, valide, refuse
            $table->text('commentaire')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('date_validation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_validations');
    }
};
